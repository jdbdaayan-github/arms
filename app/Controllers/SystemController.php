<?php

namespace App\Controllers;

use App\Models\AuditLog;
use App\Controllers\BaseController;
use CodeIgniter\Database\MySQLi\Utils;
use CodeIgniter\HTTP\ResponseInterface;

class SystemController extends BaseController
{
    public function access()
    {
        return view('system/access_logs');
    }

    public function audit()
    {
        return view('system/audit_logs');
    }

    public function ajaxLogs()
    {
        $request = $this->request;

        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $draw   = (int) $request->getPost('draw');
        $search = $request->getPost('search')['value'] ?? '';

        $orderColumnIndex = $request->getPost('order')[0]['column'] ?? 0;
        $orderDir         = $request->getPost('order')[0]['dir'] ?? 'desc';

        $columns = [
            'activities.id',
            'activities.action',
            'activities.module',
            'activities.record_id',
            'users.username',
            'activities.timestamp'
        ];

        $orderColumn = $columns[$orderColumnIndex] ?? 'activities.id';

        $model = new AuditLog();

        // BASE QUERY
        $baseBuilder = $model->builder()
            ->select('activities.id, activities.timestamp, users.username, activities.action, activities.module, activities.record_id')
            ->join('users', 'users.id = activities.user_id', 'left');

        // TOTAL RECORDS (NO SEARCH)
        $recordsTotal = (clone $baseBuilder)->countAllResults();

        // SEARCH
        if (!empty($search)) {
            $baseBuilder->groupStart()
                ->like('activities.action', $search)
                ->orLike('activities.module', $search)
                ->orLike('users.username', $search)
                ->orLike('activities.record_id', $search)
                ->groupEnd();
        }

        // FILTERED RECORDS
        $recordsFiltered = (clone $baseBuilder)->countAllResults();

        // DATA
        if ($length != -1) {
            $baseBuilder->limit($length, $start);
        }

        $data = $baseBuilder
            ->orderBy($orderColumn, $orderDir)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
            'csrfHash'        => csrf_hash(),
        ]);
    }

    public function audit_view($id)
    {
        $model = new AuditLog();
        $log = $model->select('activities.*, CONCAT_WS(" ",users.firstname, users.middlename, users.lastname, users.extension) as username')
            ->join('users', 'users.id = activities.user_id', 'left')
            ->where('activities.id', $id)
            ->first();

        if (!$log) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Audit log not found.");
        }

        // Decode JSON to objects
        $log->old_data = $log->old_data ? json_decode($log->old_data) : null;
        $log->new_data = $log->new_data ? json_decode($log->new_data) : null;

        return view('system/audit_log_detail', ['log' => $log]);
    }

    public function preferences()
    {
        return view('system/preferences');
    }

    public function profile()
    {
        return view('system/profile');
    }

    public function checkSession()
    {
        $session = session();

        if (!$session->has('user_id')) {
            return $this->response->setJSON(['alive' => false]);
        }

        $config  = config('Session');
        $timeout = $config->expiration;

        $last = $session->get('last_activity');

        if (!$last || time() - $last >= $timeout) {
            $session->destroy();
            return $this->response->setJSON(['alive' => false]);
        }

        return $this->response->setJSON(['alive' => true]);
    }

    public function backUp()
    {
        return view('system/back_up');
    }

    public function download()
    {
        $type = $this->request->getGet('type'); // database, files, full
        $format = $this->request->getGet('format'); // sql or csv
        $description = $this->request->getGet('description'); // optional

        switch ($type) {
            case 'database':
                return $this->downloadDatabase($format);
            case 'files':
                return $this->downloadFiles();
            case 'full':
                return $this->downloadFull($format);
            default:
                return redirect()->back()->with('error', 'Invalid backup type.');
        }
    }

    // Database Only
    private function downloadDatabase($format)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();

        if ($format === 'csv') {
            $zipName = 'backup_db_csv_' . date('Ymd_His') . '.zip';
            $zip = new \ZipArchive();
            $tmpFile = tempnam(sys_get_temp_dir(), 'backup');

            if ($zip->open($tmpFile, \ZipArchive::CREATE) !== TRUE) {
                return redirect()->back()->with('error', 'Cannot create zip file.');
            }

            foreach ($tables as $table) {
                $rows = $db->table($table)->get()->getResultArray();
                $csv = '';

                if (!empty($rows)) {
                    $csv .= implode(',', array_keys($rows[0])) . "\n"; // header
                    foreach ($rows as $row) {
                        $csv .= implode(',', array_map(fn($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
                    }
                }

                $zip->addFromString($table . '.csv', $csv);
            }

            $zip->close();
            return $this->response->download($zipName, file_get_contents($tmpFile), true)
                ->setHeader('Content-Type', 'application/zip');
        }

        // SQL backup (default)
        $sql = "-- Database Backup: " . date('Y-m-d H:i:s') . "\n\n";

        foreach ($tables as $table) {
            $query = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
            $sql .= $query['Create Table'] . ";\n\n";

            $rows = $db->table($table)->get()->getResultArray();
            foreach ($rows as $row) {
                $values = array_map(fn($v) => "'" . addslashes($v) . "'", $row);
                $sql .= "INSERT INTO `$table` (`" . implode('`,`', array_keys($row)) . "`) VALUES (" . implode(',', $values) . ");\n";
            }
            $sql .= "\n";
        }

        return $this->response->download('backup_db_' . date('Ymd_His') . '.sql', $sql, true);
    }

    // Files Only (PDFs)
    private function downloadFiles()
    {
        $zipName = 'backup_files_' . date('Ymd_His') . '.zip';
        $zip = new \ZipArchive();
        $tmpFile = tempnam(sys_get_temp_dir(), 'backup');

        if ($zip->open($tmpFile, \ZipArchive::CREATE) !== TRUE) {
            return redirect()->back()->with('error', 'Cannot create zip file.');
        }

        $uploadPath = WRITEPATH . 'uploads/';
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($uploadPath));

        foreach ($files as $file) {
            if (!$file->isDir() && strtolower($file->getExtension()) === 'pdf') {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($uploadPath));
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
        return $this->response->download($zipName, file_get_contents($tmpFile), true)
            ->setHeader('Content-Type', 'application/zip');
    }

    // Full Backup: Database + Files
    private function downloadFull($format)
    {
        $zipName = 'backup_full_' . date('Ymd_His') . '.zip';
        $zip = new \ZipArchive();
        $tmpFile = tempnam(sys_get_temp_dir(), 'backup');

        if ($zip->open($tmpFile, \ZipArchive::CREATE) !== TRUE) {
            return redirect()->back()->with('error', 'Cannot create zip file.');
        }

        // --- Add Database ---
        $db = \Config\Database::connect();
        $tables = $db->listTables();

        if ($format === 'csv') {
            foreach ($tables as $table) {
                $rows = $db->table($table)->get()->getResultArray();
                $csv = '';
                if (!empty($rows)) {
                    $csv .= implode(',', array_keys($rows[0])) . "\n";
                    foreach ($rows as $row) {
                        $csv .= implode(',', array_map(fn($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
                    }
                }
                $zip->addFromString($table . '.csv', $csv);
            }
        } else { // SQL
            $sql = "-- Database Backup: " . date('Y-m-d H:i:s') . "\n\n";
            foreach ($tables as $table) {
                $query = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
                $sql .= $query['Create Table'] . ";\n\n";
                $rows = $db->table($table)->get()->getResultArray();
                foreach ($rows as $row) {
                    $values = array_map(fn($v) => "'" . addslashes($v) . "'", $row);
                    $sql .= "INSERT INTO `$table` (`" . implode('`,`', array_keys($row)) . "`) VALUES (" . implode(',', $values) . ");\n";
                }
                $sql .= "\n";
            }
            $zip->addFromString('database_backup.sql', $sql);
        }

        // --- Add Files ---
        $uploadPath = WRITEPATH . 'uploads/';
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($uploadPath));
        foreach ($files as $file) {
            if (!$file->isDir() && strtolower($file->getExtension()) === 'pdf') {
                $filePath = $file->getRealPath();
                $relativePath = 'uploads/' . substr($filePath, strlen($uploadPath));
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
        return $this->response->download($zipName, file_get_contents($tmpFile), true)
            ->setHeader('Content-Type', 'application/zip');
    }
}

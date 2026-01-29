<?php

namespace App\Controllers;

use App\Models\AuditLog;
use App\Controllers\BaseController;
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
}

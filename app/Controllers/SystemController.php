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
        $start   = intval($request->getPost('start') ?? 0);
        $length  = intval($request->getPost('length') ?? 10);
        $search  = $request->getPost('search')['value'] ?? null;
        $draw    = intval($request->getPost('draw') ?? 1);

        $model = new AuditLog();
        $builder = $model->select('activities.id, activities.timestamp, users.username, activities.action, activities.module, activities.record_id')
            ->join('users', 'users.id = activities.user_id', 'left');

        // total records (without filtering)
        $recordsTotal = $model->countAll();

        // apply search
        if ($search) {
            $builder->groupStart()
                ->like('activities.action', $search)
                ->orLike('activities.module', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        // filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // limit & offset
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        // get data
        $logs = $builder->orderBy('activities.id', 'DESC')->get()->getResultArray();

        return $this->response->setJSON([
            "draw" => $draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $logs
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

    public function checkSession() {
        $session = session();
        if (!$session->get('user_id')) {
            return $this->response->setJSON(['status' => 'expired', 'message' => 'Session expired']);
        }
        return $this->response->setJSON(['status' => 'ok']);
    }
}

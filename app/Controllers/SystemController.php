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
        $model = new AuditLog();
        $logs = $model->select('activities.*, users.firstname')
                      ->join('users', 'users.id = activities.user_id', 'left')
                      ->orderBy('activities.id', 'DESC')
                      ->findAll();

        return $this->response->setJSON($logs);
    }

    public function audit_view($id)
{
    $model = new AuditLog();
    $log = $model->select('activities.*, users.username')
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
}

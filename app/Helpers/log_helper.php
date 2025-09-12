<?php

use App\Models\AuditLog;
use App\Models\RecordHistory;

if (! function_exists('audit_log')) {
    function audit_log(string $action, string $module, ?int $recordId = null, $oldData = null, $newData = null, $description = null)
    {
        $audit_model = new AuditLog();

        $userId = session()->get('user_id');
        $username = session()->get('user_name');

        $audit_model->insert([
            'user_id'    => $userId,
            'username'   => $username,
            'action'     => strtoupper($action),
            'module'     => $module,
            'record_id'  => $recordId,
            'old_data'   => $oldData ? json_encode($oldData) : null,
            'new_data'   => $newData ? json_encode($newData) : null,
            'description' => $description,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => service('request')->getUserAgent()->getAgentString(),
        ]);
    }
}

if (!function_exists('record_hisory_log')) {
    function record_hisory_log(string $action,string $record_id, string $description)
    {
        $rec_history_model = new RecordHistory();
        $user_id = session()->get('user_id');

        $rec_history_model->insert([
            'user_id' => $user_id,
            'action' => $action,
            'record_id' => $record_id,
            'description' => $description,
        ]);
    }
}
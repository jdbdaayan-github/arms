<?php

use App\Models\AuditLog;

if (! function_exists('audit_log')) {
    function audit_log(string $action, string $module, ?int $recordId = null, $oldData = null, $newData = null)
    {
        $auditModel = new AuditLog();

        $userId = session()->get('user_id');
        $username = session()->get('user_name');

        $auditModel->insert([
            'user_id'    => $userId,
            'username'   => $username,
            'action'     => strtoupper($action),
            'module'     => $module,
            'record_id'  => $recordId,
            'old_data'   => $oldData ? json_encode($oldData) : null,
            'new_data'   => $newData ? json_encode($newData) : null,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => service('request')->getUserAgent()->getAgentString(),
        ]);
    }
}
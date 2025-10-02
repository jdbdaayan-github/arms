<?php

use App\Models\RecordPermission;

if(! function_exists('hasRecordPermission')){
    function hasRecordPermission($record_id, $permission) { 
        if(session()->get('is_super') || session()->get('is_super') == 'Superadmin'){
            return true;
        }

        $rec_permission_model = new RecordPermission();
        return $rec_permission_model->hasRecordPermissions($record_id, $permission);
    }

}
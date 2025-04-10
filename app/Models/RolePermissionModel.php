<?php

namespace App\Models;

use CodeIgniter\Model;

class RolePermissionModel extends Model
{
    protected $table            = 'role_permissions';
    protected $primaryKey = null;
    protected $allowedFields    = ['role_id', 'permission_id'];

    public function getRolePermissions($roleId)
    {
        //
    }

    public function savePermissions($role_id, $permission_id)
    {
        return $this->save([
            'role_id' => $role_id,
             'permission_id' => $permission_id]);
    }

    public function deletePermission($role_id, $permission_id)
    {
        return $this->delete([
            'role_id' => $role_id,
            'permission_id'=> $permission_id
            ]);
    }
}

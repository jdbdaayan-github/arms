<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['permission_name', 'description'];

    public function getPermissions()
    {
        return $this->findAll();
    }

    public function getPermissionsForRole($role_id)
    {
        return $this->join('role_permissions', 'role_permissions.permission_id = permissions.id')
                    ->where('role_permissions.role_id', $role_id)
                    ->findAll();
    }
    
}

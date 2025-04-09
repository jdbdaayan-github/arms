<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table            = 'user_roles';
    protected $allowedFields    = ['user_id', 'role_id'];

    public function getUserRoles($user_id)
    {
        return $this->select('roles.role_name')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $user_id)
            ->findAll();
    }
}

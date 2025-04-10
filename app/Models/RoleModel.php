<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['role_name', 'description'];

    public function getRoles()
    {
        return $this->orderBy('id', 'asc')->findAll();
    }
}

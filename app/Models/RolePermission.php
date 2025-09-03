<?php

namespace App\Models;

use CodeIgniter\Model;

class RolePermission extends Model
{
    protected $table            = 'role_permissions';
    protected $primaryKey       = ['role_id', 'permission_id'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'permission_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPermissionsByRole($role_id)
    {
        return $this->select('permissions.id, permissions.permission_name, permissions.description')
                ->join('permissions', 'permissions.id = role_permissions.permission_id')
                ->where('role_permissions.role_id', $role_id)
                ->findAll();
    }
}

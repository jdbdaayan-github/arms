<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRole extends Model
{
    protected $table            = 'user_roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'user_id'];

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

    public function getUserRoles($user_id)
    {
        return $this->select('roles.role_name')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $user_id)
            ->findAll();
    }

    public function getUserRolebyId($user_id)
    {
        return $this->select('roles.id')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $user_id)
            ->findAll();
    }

    public function addUserRole($data)
    {
        $this->save($data);
    }
}

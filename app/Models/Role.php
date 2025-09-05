<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_name', 'description'];

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

    public function getRoles()
    {
        $userRole = session()->get('role');

        $roles = $this->findAll();

        if ($userRole !== 'Superadmin') {
            $roles = array_filter($roles, function ($role) {
                return $role->role_name !== 'Superadmin';
            });
            $roles = array_values($roles);
        }

        return $roles;
    }

    public function getRoleById($id)
    {
        return $this->find($id);
    }

    public function saveRole($data):int
    {
        $roleID = $this->insert($data); //put inserted Id in variable for logs

        return $roleID;
    }

    public function updateRole($id, $data)
    {
        return $this->update($id, $data);
    }
}

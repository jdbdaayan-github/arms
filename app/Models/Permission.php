<?php

namespace App\Models;

use CodeIgniter\Model;

class Permission extends Model
{
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['permission_name', 'description'];

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

     public function getPermissions()
    {
        return $this->findAll();
    }

    public function getPermissionById($id)
    {
        return $this->find($id);
    }

    public function addPermission($data):int
    {
        $this->save($data);
        return $this->getInsertID();
    }

    public function updatePermission($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletePermission($id)
    {
        return $this->delete($id);
    }
        
    public function getPermissionsForRole($role_id)
    {
        return $this->join('role_permissions', 'role_permissions.permission_id = permissions.id')
                    ->where('role_permissions.role_id', $role_id)
                    ->findAll();
    }

    public function getPermissionsByUserId($user_id)
    {
        $permissions = $this->select('permissions.permission_name as permission_name')
                            ->join('role_permissions rp', 'permissions.id = rp.permission_id')
                            ->join('user_roles', 'user_roles.role_id = rp.role_id')
                            ->join('roles', 'roles.id = user_roles.role_id')
                            ->where('user_roles.user_id', $user_id)
                            ->groupBy('permissions.permission_name')
                            ->findAll();

        return array_column($permissions, 'permission_name');
    }
}

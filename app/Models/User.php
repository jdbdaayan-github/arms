<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['firstname', 'middlename', 'lastname', 'extension', 'email', 'username', 'password', 'status_id', 'role_id', 'is_super', 'verified', 'login_attempts'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function insertUser($data)
    {
        return $this->insert($data);
    }
    
    public function getUserRoleByUserId($id)
    {
        return $this->select('roles.role_name')->join('roles','roles.id = users.role_id')->where('users.id', $id)
        ->first();
    }

    public function getUsersData()
    {
        return $this->select('users.id,CONCAT_WS(" ", firstname, middlename, lastname, extension) as Fullname, email,username, password, status_id,verified, login_attempts ,user_statuses.name as status, roles.role_name as role_name')
                    ->join('user_statuses', 'user_statuses.id = users.status_id')
                    ->join('roles', 'roles.id = users.role_id')
                    ->findAll();
    }

    public function updateProfile($id, $data)
    {
        return $this->update($id, $data);
    }

    public function updateStatus($id,$data)
    {
        return $this->update($id, $data);
    }

    //dashboard data
    public function getLatestUsers()
    {
        return $this->select('users.email,users.created_at, users.id,CONCAT_WS(" ", users.firstname, users.middlename, users.lastname, users.extension) as name, roles.role_name as role_name')
                    ->join('roles', 'roles.id = users.role_id')
                    ->findAll(5);
    }

    public function resetAttempts($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function insertResetPassword($id,$data)
    {
        return $this->update($id, $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['firstname', 'middlename', 'lastname', 'extension', 'email', 'office_id', 'username', 'password','status_id', 'verified', 'login_attempts'];


    public function getUsers()
    {

        return $this->select('users.*, offices.code as office_code, user_statuses.name as status_name, GROUP_CONCAT(roles.role_name) as role_names')
                    ->join('offices', 'offices.id = users.office_id')
                    ->join('user_statuses', 'user_statuses.id = users.status_id')
                    ->join('user_roles', 'user_roles.user_id = users.id')  // Join user_roles to link users to their roles
                    ->join('roles', 'roles.id = user_roles.role_id')  // Join roles to fetch the role names
                    ->groupBy('users.id')  // Group by user to ensure roles are combined for each user
                    ->orderBy('lastname', 'asc')
                    ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'userID';

    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['firstName', 'middleName', 'lastName', 'extensionName', 'email', 'directorate_id', 'office_id', 'status', 'locked', 'username', 'password'];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}

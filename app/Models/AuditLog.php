<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLog extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'timestamp',
        'user_id',
        'username',
        'action',
        'module',
        'record_id',
        'old_data',
        'new_data',
        'description',
        'ip_address',
        'user_agent'
    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'timestamp';
    protected $updatedField = '';

    public function getRecentActivity()
    {
        return $this->orderBy('timestamp', 'desc')->findAll(5);
    }
}
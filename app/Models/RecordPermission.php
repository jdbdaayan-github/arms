<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordPermission extends Model
{
    protected $table            = 'record_permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    public function hasRecordPermissions($record_id, $permission)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return false;
        }

        $result = $this->select('urp.*, record_permissions.*')
            ->join('user_record_permissions urp', 'urp.record_permission_id = record_permissions.id')
            ->where('record_permissions.name', $permission)
            ->where('urp.record_id', $record_id)
            ->where('urp.user_id', $userId)
            ->first();

        return !empty($result);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordIndexValue extends Model
{
    protected $table            = 'record_index_values';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['record_id', 'index_id', 'value'];

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

    public function getRecordIndexValues($record_id)
    {
        return $this->select('record_index_values.id, record_id, index_id, value, ri.name as index_name')
                    ->join('record_indexes ri', 'ri.id = record_index_values.index_id')
                    ->where('record_id', $record_id)->findAll();
    }
    
    public function insertRecordIndexValue($data)
    {
        return $this->insert($data);
    }

    public function updateRecordIndexValue($id, $data)
    {
        return $this->where('record_id', $id)->update($data);
    }
}

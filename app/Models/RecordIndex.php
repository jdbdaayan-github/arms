<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordIndex extends Model
{
    protected $table            = 'record_indexes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'type', 'length', 'placeholder', 'required'];

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

    public function getIndexesList()
    {
        return $this->findAll();
    }

    public function getRecordIndexByID($id)
    {
        return $this->find($id);
    }

    public function saveRecIndex($data)
    {
        return $this->insert($data);
    }

    public function updateRecIndex($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getSeriesIndexesById($id)
    {
        return $this->select('record_indexes.*')
            ->join('record_series_indexes si', 'si.record_index_id = record_indexes.id')
            ->join('record_series rs', 'rs.id = si.record_series_id')
            ->where('si.record_series_id', $id)
            ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordSeries extends Model
{
    protected $table            = 'record_series';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code', 'name','classification_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = TRUE;
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

    public function getSeries()
    {
        return $this->select('record_series.id, record_series.code, record_series.name, classification_id, rc.name as classification')
                    ->join('record_classifications rc','rc.id = record_series.classification_id')
                    ->findAll();
    }

    public function insertSeries($data)
    {
        return $this->insert($data);
    }

    public function getSeriesById($id)
    {
        return $this->find($id);
    }

    public function updateSeries($id, $data)
    {
        return $this->update($id, $data);
    }
}

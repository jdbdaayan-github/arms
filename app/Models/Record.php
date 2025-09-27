<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class Record extends Model
{
    protected $table            = 'records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'series_id', 'confidential', 'status_id', 'record_date', 'created_by', 'updated_by', 'deleted_by'];

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
    protected $afterInsert    = ['generateRefNumber'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $oldData = null;

    protected function generateRefNumber(array $data)
{
    $data['data']['ref_number'] = 'REC-' . date('Ymd') . '-' . str_pad(uniqid(), 6, '0', STR_PAD_LEFT);
    return $data;
}

    public function getRecords()
    {
        $role = session()->get('role');
        $user_id = session()->get('user_id');

    if ($role == 'Contributor') {
        return $this->where('created_by', $user_id)->orderBy('created_at', 'DESC');
    }

    // Admins or other roles see all records
    return $this->orderBy('created_at', 'DESC');
    }

    public function getRecordById($id)
    {
        return $this->select('records.*, record_series.name as series, record_statuses.name as status, record_file_versions.filename as filename, record_file_versions.version as version , CONCAT_WS(" ", users.firstname, users.middlename, users.lastname, users.extension) as user_name')
            ->join('record_series', 'record_series.id=records.series_id')
            ->join('record_statuses', 'record_statuses.id = records.status_id')
            ->join('record_file_versions', 'record_file_versions.record_id = records.id', 'left')
            ->join('users', 'users.id = records.created_by')
            ->find($id);
    }

    public function insertRecord($data)
    {
        return $this->insert($data);
    }

    public function getRecentRecords()
    {
        return $this->findAll(5);
    }

    public function getForApprovalData()
    {
        return $this->where('status_id', 2);
    }

    public function countPendingApproval(): int
    {
        return $this->getForApprovalData()->countAllResults();
    }

    public function getForArchivalData()
    {
        return $this->where('status_id', 3);
    }

    public function countPendingArchival(): int
    {
        return $this->getForArchivalData()->countAllResults();
    }

    public function getArchivedData()
    {
        return $this->where('status_id', 4);
    }
}

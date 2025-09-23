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
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $oldData = null;

    public function storeOldData(array $data)
    {
        if (!empty($data['id'])) {
            $this->oldData = $this->find($data['id'][0]);
        }
        return $data;
    }

    // Log insert
    protected function logInsert(array $data)
    {
        $history = new RecordHistory();
        $history->insert([
            'record_id' => $data['id'],
            'action'      => 'created',
            'old_data'    => null,
            'new_data'    => json_encode($data['data']),
            'user_id'     => session()->get('user_id'),
        ]);
        return $data;
    }

    // Log update
    protected function logUpdate(array $data)
    {
        $history = new RecordHistory();
        $history->insert([
            'record_id' => $data['id'][0],
            'action'      => 'updated',
            'old_data'    => json_encode($this->oldData),
            'new_data'    => json_encode($data['data']),
            'user_id'     => session()->get('user_id'),
        ]);
        return $data;
    }

    // Log delete
    protected function logDelete(array $data)
    {
        $history = new RecordHistory();
        $history->insert([
            'record_id' => $data['id'][0],
            'action'      => 'deleted',
            'old_data'    => json_encode($this->find($data['id'][0])),
            'new_data'    => null,
            'user_id'     => session()->get('user_id'),
        ]);
        return $data;
    }

    public function getRecords()
    {
        $role = session()->get('role');
    $user_id = session()->get('user_id');

    if ($role === 'Contributor') {
        // Contributor sees only their own records
        return $this->where('created_by', $user_id)->findAll();
    }

    // Admins or other roles see all records
    return $this->findAll();
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

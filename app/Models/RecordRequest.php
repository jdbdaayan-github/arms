<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class RecordRequest extends Model
{
    protected $table            = 'record_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['record_id', 'user_id', 'request_date', 'request_id', 'remarks', 'status', 'due_date'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

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

    public function getAllRequest()
{
    $builder = $this->select('
            record_requests.*,
            record_requests.id as request_id,
            records.*,
            CONCAT_WS(" ", users.firstname, users.middlename, users.lastname, users.extension) as fullname
        ')
        ->join('users', 'users.id = record_requests.user_id')
        ->join('records', 'records.id = record_requests.record_id');

    // Role-based filtering
    if (
        ! hasRole('Superadmin') &&
        ! hasRole('Administrator') &&
        ! hasRole('Archivist')
    ) {
        // Contributor → own requests only
        $builder->where('record_requests.user_id', session()->get('user_id'));
    }

    return $builder;
}


    public function addRequest($data)
    {
        return $this->insert($data);
    }

    public function updateRequest($id, $data)
    {
        return $this->update($id, $data);
    }

    public function countPendingRequest(){
        return $this->where('status', 'Pending')->countAllResults();
    }

    public function getRequestById($id) {
        return $this->select('record_requests.*,records.*,rqt.name as request_type,CONCAT_WS(" ", u.firstname, u.middlename, u.lastname, u.extension) as user_name')
                    ->join('records', 'records.id = record_requests.record_id')
                    ->join('record_request_types rqt', 'rqt.id = record_requests.request_id')
                    ->join('users u', 'u.id = record_requests.user_id')
                    ->where('record_requests.id', $id)
                    ->first();
    }
}

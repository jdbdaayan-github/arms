<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordFileVersion extends Model
{
    protected $table            = 'record_file_versions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['record_id', 'user_id', 'filename', 'randomfilename', 'version', 'note'];

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

    public function insertRecordFileVersion($data)
    {
        return $this->insert($data);
    }

    public function getVersionByRecordId($id)
    {
        return $this->select('record_file_versions.created_at,record_id,filename, version, randomfilename, CONCAT_WS(" ",users.firstname, users.middlename, users.lastname, users.extension) as user_name')
                    ->join('users', 'users.id = record_file_versions.user_id')
                    ->where('record_id', $id)->findAll();
    }

    public function getLatestVersionByRecordId($id)
    {
        return $this->select('record_file_versions.created_at,record_id,filename, version, randomfilename, CONCAT_WS(" ",users.firstname, users.middlename, users.lastname, users.extension) as user_name')
                    ->join('users', 'users.id = record_file_versions.user_id')
                    ->where('record_id', $id)
                    ->orderBy('created_at', 'desc')->first();
    }

    public function deleteFiles($id)
    {
        return $this->where('record_id', $id)->delete();
    }

    
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class OfficeModel extends Model
{
    protected $table            = 'offices';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['code', 'name', 'directorate_id'];

    public function getOffices()
    {
        return $this->select('offices.*, directorates.code as directorate_code')
                ->join('directorates', 'directorates.id = offices.directorate_id')
                ->findAll();
    }

    public function getOfficesById($id)
    {
        return $this->find($id);
    }

    public function addOffice($data)
    {
        $this->save($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class DirectorateModel extends Model
{
    protected $table            = 'directorates';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['code', 'name'];

    public function getDirectorates()
    {
        return $this->findAll();
    }

    public function addDirectorate($data)
    {
        $this->save($data);
    }

    public function getDirectorate($id)
    {
        return $this->find($id);
    }
}

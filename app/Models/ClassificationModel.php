<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassificationModel extends Model
{
    protected $table            = 'record_classifications';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['code', 'name'];

    public function getClassifications()
    {
        return $this->findAll();
    }
}

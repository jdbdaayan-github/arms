<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordCategory extends Model
{
    protected $table            = 'record_categories';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['code', 'name','classification_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    public function getCategories()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    


}

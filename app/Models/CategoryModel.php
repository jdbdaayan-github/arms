<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'record_categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['code', 'name', 'classification_id'];

    public function getCategories()
    {
        return $this->select('record_categories.id, record_categories.code, record_categories.name, record_classifications.name as classification_name')
                    ->join('record_classifications', 'record_classifications.id = record_categories.classification_id')
                    ->findAll();
    }
}

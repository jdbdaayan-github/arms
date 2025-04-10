<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'record_categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['code', 'name'];

    public function getCategories()
    {
        return $this->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Directorate extends Model
{
    protected $table            = 'directorates';
    protected $primaryKey       = 'directorateID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['directorateCode', 'directorateName'];

   public function getDirectorates()
   {
    return $this->findAll();
   }
}

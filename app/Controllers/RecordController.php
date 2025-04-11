<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RecordController extends BaseController
{
    public function index()
    {
        return view("pages/records/index");
    }
}

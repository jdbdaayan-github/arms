<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RoleController extends BaseController
{
    public function index()
    {
        return view('pages/roles/index');
    }

    public function create()
    {
        return view('pages/roles/create');
    }
}

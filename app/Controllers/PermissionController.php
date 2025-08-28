<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionController extends BaseController
{
    public function index()
    {
        return view('pages/permissions/index');
    }

    public function create()
    {
        return view('pages/permissions/create');
    }
}

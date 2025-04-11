<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SystemController extends BaseController
{
    public function index()
    {
        //
    }

    public function audit()
    {
        return view('system/audit_logs');
    }
}

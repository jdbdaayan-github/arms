<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SystemController extends BaseController
{
    public function access()
    {
        return view('system/access_logs');
    }

    public function audit()
    {
        return view('system/audit_logs');
    }

    public function preferences()
    {
        return view('system/preferences');
    }

    public function profile()
    {
        return view('system/profile');
    }
}

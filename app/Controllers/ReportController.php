<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{
    public function borrowed()
    {
        return view('pages/reports/borrowed');
    }

    public function returned()
    {
        return view('pages/reports/returned');
    }

    public function users()
    {
        return view('pages/reports/users');
    }

    public function summary()
    {
        return view('pages/reports/summary');
    }

    public function uploaded()
    {
        return view('pages/reports/uploaded');
    }
}

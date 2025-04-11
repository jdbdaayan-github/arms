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

    public function create()
    {
        //
    }

    public function store()
    {
      //
    }
    public function show()
    {
        return view("pages/records/view");
    }

    public function search()
    {
        return view("pages/records/search");
    }

    public function track_history()
    {
        return view('pages/records/track_history');
    }
}

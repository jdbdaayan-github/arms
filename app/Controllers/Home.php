<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function home()
    {
        return view('pages/records/recordsdash');
    }

    public function index(): string
    {
        return view('pages/dashboard');
    }

    public function addrecord()
    {
        return view('pages/records/recordscreate');
    }

    public function advancedSearch()
    {
        return view('pages/records/advancedsearch');
    }
}

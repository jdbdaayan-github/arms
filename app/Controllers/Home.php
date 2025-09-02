<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function records()
    {
        return view('pages/records/index');
    }

    public function search()
    {
        return view('pages/records/search');
    }

    public function create()
    {
        return view('pages/records/create');
    }

    public function view()
    {
        return view('pages/records/view');
    }
}

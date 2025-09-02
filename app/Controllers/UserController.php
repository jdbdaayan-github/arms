<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return view('pages/users/index');
    }

    public function profile($id)
    {
        $user_model = new User();
        $user = $user_model->getUserById($id);
        
        return view('pages/users/profile',['user' => $user]);
    }
}

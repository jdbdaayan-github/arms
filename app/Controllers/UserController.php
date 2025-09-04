<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $user_model;

    public function __construct()
    {
        $this->user_model = new User();
    }
    public function index()
    {
        return view('pages/users/index');
    }

    public function ajaxUsersData()
    {
        $users = $this->user_model->getUsersData();

        return $this->response->setJSON($users);
    }

    public function profile($id)
    {
        $user_model = new User();
        $user = $user_model->getUserById($id);
        
        return view('pages/users/profile',['user' => $user]);
    }

    public function toggleVerify($id)
    {
        $user = $this->user_model->find($id);

        if($user)
        {
            $newStatus = ($user->verified == 1) ? 0 : 1;

            $data = [
                'verified' => $newStatus,
            ];
            $this->user_model->updateStatus($id, $data);

            $status = "verified";

            if($newStatus == 0)
            {
                $status = "unverified";
            }

            return redirect()->to('users')->with('success', 'User '.$status.' successfully');
        }
    }

    public function resetAttempts($id)
    {
        
    }
    
}

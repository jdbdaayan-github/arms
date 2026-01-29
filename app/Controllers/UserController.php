<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $user_model;
    protected $permission_model;
    protected $role_model;

    public function __construct()
    {
        $this->user_model = new User();
        $this->permission_model = new Permission();
        $this->role_model = new Role();
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

    public function profileUpdate($id)
    {
        $rules = [
            'firstname' => 'required',
            'middlename' => 'permit_empty',
            'lastname' => 'required',
            'extension' => 'permit_empty',
            'email' => "valid_email|required|is_unique[users.email,id,{$id}]",
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'extension' => $this->request->getPost('extension'),
            'email' => $this->request->getPost('email'),
        ];

        if($this->user_model->updateProfile($id, $data))
        {
            return redirect()->to('users/profile/'.$id)->with('success', 'Your profile updated successfully!');
            
        }
        return redirect()->to('users/profile/'.$id)->with('error', 'There is a problem when updating on your profile');
    }

    public function profilePassUpdate($id)
    {
        $user = $this->user_model->getUserById($id);

        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $old_pass = $this->request->getPost('old_password');

        if(!password_verify($old_pass, $user->password))
        {
            return redirect()->back()->withInput()->with('error_pass', 'Wrong password');
        }

        $data = [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ];

        if(!$this->user_model->updateProfile($id, $data)) {
            return redirect()->to('users/profile/'.$id)->with('error', 'Error when changing password');
        }

        return redirect()->to('users/profile/'.$id)->with('success', 'Password updated successfully');
    }

    public function toggleVerify($id)
    {
        $user = $this->user_model->find($id);

        if($user)
        {
            $newStatus = ($user->verified == 1) ? 0 : 1;
            $newStatusState = ($newStatus == 1) ? 2 : 1;

            $data = [
                'verified' => $newStatus,
                'status_id' => $newStatusState,
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

    public function resetAttempts($id) {
        $data = [
            'login_attempts' => 0,
            'status_id' => 2,
        ];

        $this->user_model->resetAttempts($id, $data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User attempts reset successfully',
            'redirect' => base_url('users') // controller decides redirect
        ]);
    }
    
    public function create()
    {
        $role_model = new Role();
        $data['roles'] = $role_model->getRoles();
        return view('pages/users/create', $data);
    }

    public function store()
    {
        $rules = [
            'firstname' => 'required',
            'middlename' => 'permit_empty',
            'lastname' => 'required',
            'extension' => 'permit_empty',
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|is_unique[users.email]',
            'password' => 'required',
            'role' => 'required',
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $hash_password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'extension' => $this->request->getPost('extension'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $hash_password,
            'role_id' => $this->request->getPost('role'),
        ];

        if(!$this->user_model->insertUser($data)) {
            return redirect()->to('users')->with('error', 'Error when saving data');
        }

        return redirect()->to('users')->with('success', 'Created user successfully!');
    }

    public function edit($id) {

        $data['user'] = $this->user_model->getUserById($id);
        $data['roles'] = $this->role_model->getRoles();
        return view('pages/users/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'firstname' => 'required',
            'middlename' => 'permit_empty',
            'lastname' => 'required',
            'extension' => 'permit_empty',
            'email' => "required|is_unique[users.email,id,{$id}]",
            'username' => "required|is_unique[users.username,id,{$id}]",
            'password' => 'permit_empty',
            'role' => 'required'
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'extension' => $this->request->getPost('extension'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $hash, 
            'role_id' => $this->request->getPost('role'),
        ];

        if(!$this->user_model->updateUser($id, $data))
        {
            return redirect()->to('users')->with('error', 'There is an error when updating!');
        }

        return redirect()->to('users')->with('success', 'User updated successfully!');
    }

    public function user_permissions($user_id)
    {
        $data['user'] = $this->user_model->getUserById($user_id);
        $data['user_permissions'] = $this->permission_model->getPermissions();
        return view('pages/users/user_permissions', $data);
    }

    public function set_user_permission()
    {
        
    }
}

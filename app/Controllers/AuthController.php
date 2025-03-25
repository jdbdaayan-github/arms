<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'firstName'        => 'required',
                'middleName'       => 'permit_empty',
                'lastName'         => 'required',
                'extensionName'    => 'permit_empty',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'username'         => 'required|is_unique[users.username]',
                'password'         => 'required|min_length[8]',
                'confirmPassword'  => 'required|matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            // If validation passes, save user
            $userModel = new User();
            $userModel->insert([
                'firstName'      => $this->request->getPost('firstName'),
                'middleName'     => $this->request->getPost('middleName'),
                'lastName'       => $this->request->getPost('lastName'),
                'extensionName'  => $this->request->getPost('extensionName'),
                'username'       => $this->request->getPost('username'),
                'status' => 1,  // Default to active
                'locked' => 0,  // Default to unlocked
                'email'          => $this->request->getPost('email'),
                'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ]);
            $errors = $userModel->errors();
if (!empty($errors)) {
    print_r($errors);
    exit;
}

            return redirect()->to('login')->with('success', 'Registration successful. You can now log in.');
        }
        return view('auth/register');
    }
}

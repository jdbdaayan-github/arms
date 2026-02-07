<?php

namespace App\Controllers;

use App\Models\User;
use Config\Services;
use App\Models\Permission;
use App\Controllers\BaseController;
use App\Controllers\CaptchaController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Email;

class AuthController extends BaseController
{
    public function login()
    {
        $captcha_controller = new CaptchaController();
        $data['captcha_image'] = $captcha_controller->generate();

        return view('auth/login', $data);
    }

    public function authenticate()
    {

        $session = session();

        $rules = [
            'user' => 'required|max_length[30]',
            'password' => 'required|max_length[255]|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $captcha_word = $session->get('captcha_word');
        $user = $this->request->getPost('user');
        $password = $this->request->getPost('password');
        $captcha_input = $this->request->getPost('captcha');

        $user_model = new User();
        $user = $user_model->where('email', $user)->orWhere('username', $user)->first();

        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'Invalid username or password.');
        }

        if ($user->login_attempts >= 5) {
            return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.');
        }

        // Verify the user’s account
        if ($user->verified == 0) {
            return redirect()->to('/auth/login')->with('error', 'Your account has not been verified. Contact the administrator.')->withInput();
        }

        // Verify password
        if (!password_verify($password, $user->password)) {
            $newAttempts = $user->login_attempts + 1;
            $user_model->update($user->id, ['login_attempts' => $newAttempts]);

            if ($newAttempts >= 5) {
                $user_model->update($user->id, ['status_id' => 5]);
                return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.')->withInput();
            }

            return redirect()->to('/auth/login')->with('error', 'Invalid email or password.')->withInput();
        }
        
        // Check the CAPTCHA input
        if ($captcha_input !== $captcha_word) {
            $newAttempts = $user->login_attempts + 1;
            $user_model->update($user->id, ['login_attempts' => $newAttempts]);

            if ($newAttempts >= 5) {
                $user_model->update($user->id, ['status_id' => 5]);
                return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.')->withInput();
            }

            return redirect()->to('/auth/login')->with('error', 'Incorrect CAPTCHA. Please try again.')->withInput();
        }


        // Reset login attempts after successful login
        $user_model->update($user->id, ['login_attempts' => 0]);


        //Get user permissions
        $permissionModel = new Permission();
        $permission = $permissionModel->getPermissionsByUserId($user->id);

        // Prepare full name (fixed concatenation)
        $fullName = $user->firstname . " " . $user->middlename . " " . $user->lastname . " " . $user->extension;

        $role = $user_model->getUserRoleByUserId($user->id);

        // Store session data
        $session->set([
            'user_id'   => $user->id,
            'user_name' => $fullName,
            'user_email' => $user->email,
            'role'     => $role->role_name,
            'permissions' => $permission,
            'is_super' => $user->is_super,
            'logged_in' => TRUE,
            'last_activity' => time(),
        ]);

        // Remove generated Captcha
        $session->remove(['captcha_word', 'captcha_filename']);

        audit_log('LOGIN', 'auth', null, null, null, 'Logged in');

        if ($role->role_name === 'Superadmin') {
            return redirect()->to('/dashboard/superadmin')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Administrator') {
            return redirect()->to('/dashboard/administrator')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Standard User') {
            return redirect()->to('/dashboard/standard_user')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        // fallback kung may unknown role
        return redirect()->to('/')
            ->with('error', 'Unauthorized role');
    }

    public function register()
    {
        $captcha_controller = new CaptchaController();
        $data['captcha_image'] = $captcha_controller->generate();

        return view('auth/register', $data);
    }

    public function store()
    {
        $captcha_word = session()->get('captcha_word');

        $rules = [
            'firstname' => ['label' => 'First Name', 'rules' => 'required'],
            'middlename' => 'permit_empty',
            'lastname' => 'required',
            'extension' => 'permit_empty',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'password_confirm' => ['label' => 'Confirm Password', 'rules' => 'match[password]']
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if($this->request->getPost('captcha') != $captcha_word) {
            return redirect()->back()->withInput()->with('error', 'Incorrect CAPTCHA. Please try again!');
        }
    }

    public function logout()
    {
        session()->destroy();
        audit_log('LOGOUT', 'auth', null, null, null, 'Logged out');
        return redirect()->to('auth/login');
    }



    public function reset1()
    {
        return view('auth/reset_password');
    }

    public function terms()
    {
        return view('auth/terms');
    }

    public function forgot()
    {
        session();
        return view('auth/forgot_password');
    }
    public function reset()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|email_exists',
                'errors' => [
                    'email_exists' => 'This email is not exists/registered in our system.'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            //dd(session());
            return redirect()->to(previous_url() ?? '/auth/forgot')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $emailAddress = $this->request->getPost('email');

        $user_model = new User();

        $user = $user_model->getUserByEmail($emailAddress);

        // Generate a random password (8 chars: letters + numbers)
        $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        // Hash the password before saving to DB (assuming "users" table)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $data = ['password' => $hashedPassword];

        if ($user->login_attempts > 4) {
            $data['login_attempts'] = 0;
        }

        $user_model->insertResetPassword($user->id, $data);

        $configEmail = config('Email');

        // Send email with new password
        $email = \Config\Services::email();
        $email->setFrom($configEmail->fromEmail, 'ARMS Support');
        $email->setTo($emailAddress);
        $email->setSubject('Your New Password');
        $email->setMessage("
        <h2>Password Reset</h2>
        <p>Hello,</p>
        <p>Your new password is:</p>
        <p><strong>{$newPassword}</strong></p>
        <p>Please log in using this password and change it immediately for security.</p>
    ");

        if ($email->send()) {
            return "✅ New password sent. Please check your email and return to <a href=" . base_url("auth/login") . "> Login </a>";
        } else {
            return "❌ Failed to send reset email.<br>" . $email->printDebugger(['headers']);
        }
    }

    public function new_password()
    {
        return view('pages/auth/new_password');
    }
}

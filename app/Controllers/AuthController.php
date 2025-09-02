<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Controllers\BaseController;
use App\Controllers\CaptchaController;
use CodeIgniter\HTTP\ResponseInterface;

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
        helper('form');

        $session = session();
        $captcha_word = $session->get('captcha_word');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $captcha_input = $this->request->getPost('captcha');

        $user_model = new User();
        $user = $user_model->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'Invalid username or password.');
        }

        if ($user->login_attempts >= 5) {
            return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.');
        }

        // Verify the user’s account
        if ($user->verified == 0) {
            return redirect()->to('/auth/login')->with('error', 'Your account has not been verified. Contact the administrator.');
        }

        // Check the CAPTCHA input
        if ($captcha_input !== $captcha_word) {
            $newAttempts = $user->login_attempts + 1;
            return redirect()->to('/auth/login')->with('error', 'Incorrect CAPTCHA. Please try again.');
        }

        // Verify password
        if (!password_verify($password, $user->password)) {
            $newAttempts = $user->login_attempts + 1;
            $user_model->update($user->id, ['login_attempts' => $newAttempts]);

            if ($newAttempts >= 5) {
                $user_model->update($user->id, ['status_id' => 4]);
                return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.');
            }

            return redirect()->to('/auth/login')->with('error', 'Invalid username or password.');
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
            'logged_in' => TRUE,
        ]);

        // Remove generated Captcha
        $session->remove(['captcha_word', 'captcha_filename']);

        if ($role->role_name == 'Super Admin') {
            return redirect()->to('/')->with('success', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name == 'Administrator') {
            return redirect()->to('dashboard/a')->with('success', 'Welcome! ' . $user->firstname);
        }

        return redirect()->to('dashboard/b')->with('success', 'Welcome! ' . $user->firstname);
    }

    public function register()
    {
        $captcha_controller = new CaptchaController();
        $data['captcha_image'] = $captcha_controller->generate();

        return view('auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('auth/login');
    }

    public function forgot()
    {
        return view('auth/forgot_password');
    }

    public function reset()
    {
        return view('auth/reset_password');
    }

    public function terms()
    {
        return view('auth/terms');
    }
}

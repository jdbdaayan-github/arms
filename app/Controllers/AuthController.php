<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserRoleModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Instantiate the CaptchaController
        $captchaController = new CaptchaController();

        // Get the CAPTCHA image as base64
        $captcha_image_base64 = $captchaController->generate();

        // Return the login view with the CAPTCHA image base64 data
        return view("auth/login", ['captcha_image' => $captcha_image_base64]);
    }

    public function authenticate()
    {
        $session = session();
        $captcha_word = $session->get('captcha_word');
        $captcha_filename = $session->get('captcha_filename');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $captcha_input = $this->request->getPost('captcha');

        $userModel = new UserModel();
        $userRoleModel = new UserRoleModel();

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/')->with('errors', 'Invalid username or password.');
        }

        if ($user['login_attempts'] >= 3) {
            return redirect()->to('/')->with('errors', 'Your account is locked due to multiple failed login attempts. Contact the administrator.');
        }

        if ($user['verified'] == 0) {
            return redirect()->to('/')->with('errors', 'Your account has not been verified. Contact the administrator.');
        }

        if ($captcha_input !== $captcha_word) {
            return redirect()->to('/')->with('errors', 'Incorrect CAPTCHA.');
        }

        if (!password_verify($password, $user['password'])) {
            $userModel->update($user['id'], ['login_attempts' => $user['login_attempts'] + 1]);
            return redirect()->to('/')->with('errors', 'Invalid username or password.');
        }

        $userModel->update($user['id'], ['login_attempts' => 0]);

        $roles = $userRoleModel->getUserRoles($user['id']);
        $userRoles = array_column($roles, 'role_name');

        $session->set([
            'user_id'   => $user['id'],
            'user_name'  => $user['firstname']." ".$user['middlename']." ".$user['lastname'],
            'roles'     => $userRoles,
            'logged_in' => TRUE,
        ]);

        // Delete used CAPTCHA image
        if ($captcha_filename && file_exists($captcha_filename)) {
            unlink($captcha_filename);
        }

        $session->remove(['captcha_word', 'captcha_filename']);

        return redirect()->to('dashboard')->with('success', 'Welcome! '. $user['firstname']);
    }
}

<?php

namespace App\Controllers;

use App\Models\User;
use Config\Services;
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

        $session = session();

        $rules = [
            'email' => 'required|max_length[30]|valid_email',
            'password' => 'required|max_length[255]|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

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
            return redirect()->to('/auth/login')->with('error', 'Your account has not been verified. Contact the administrator.')->withInput();
        }

        // Check the CAPTCHA input
        if ($captcha_input !== $captcha_word) {
            $newAttempts = $user->login_attempts + 1;
            return redirect()->to('/auth/login')->with('error', 'Incorrect CAPTCHA. Please try again.')->withInput();
        }

        // Verify password
        if (!password_verify($password, $user->password)) {
            $newAttempts = $user->login_attempts + 1;
            $user_model->update($user->id, ['login_attempts' => $newAttempts]);

            if ($newAttempts >= 5) {
                $user_model->update($user->id, ['status_id' => 4]);
                return redirect()->to('/auth/login')->with('error', 'Your account is locked due to multiple failed login attempts. Contact the administrator.')->withInput();
            }

            return redirect()->to('/auth/login')->with('error', 'Invalid username or password.')->withInput();
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
        ]);

        // Remove generated Captcha
        $session->remove(['captcha_word', 'captcha_filename']);

        audit_log('LOGIN', 'auth', null, null, null, 'Logged in');

        if ($role->role_name === 'Superadmin') {
            return redirect()->to('/dashboard/superadmin')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Administrator') {
            return redirect()->to('/dashboard/admin')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Archivist') {
            return redirect()->to('/dashboard/archivist')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Records Officer') {
            return redirect()->to('/dashboard/records-officer')
                ->with('login', 'Welcome! ' . $user->firstname);
        }

        if ($role->role_name === 'Contributor') {
            return redirect()->to('/dashboard/contributor')
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

    public function logout()
    {
        session()->destroy();
        audit_log('LOGOUT', 'auth', null, null, null, 'Logged out');
        return redirect()->to('auth/login');
    }

    public function forgot()
    {
        return view('auth/forgot_password');
    }

    public function reset1()
    {
        return view('auth/reset_password');
    }

    public function terms()
    {
        return view('auth/terms');
    }

    public function reset()
    {
        $emailAddress = $this->request->getPost('email') ?? 'testuser@example.com';

        // Fake token (normally from DB)
        $token = bin2hex(random_bytes(16));
        $resetLink = base_url('auth/resetPassword/' . $token);

        // Send email
        $email = Services::email();
        $email->setFrom('noreply@erms.local', 'ERMS Support');
        $email->setTo($emailAddress);
        $email->setSubject('Password Reset Request');
        $email->setMessage("
            <h2>Password Reset</h2>
            <p>Hello,</p>
            <p>Click below to reset your password:</p>
            <p><a href='{$resetLink}'>{$resetLink}</a></p>
        ");

        if ($email->send()) {
            return "✅ Reset email sent! Check MailHog at <a href='http://localhost:8025'>http://localhost:8025</a>";
        } else {
            return "❌ Failed to send reset email.<br>" . $email->printDebugger(['headers']);
        }
    }

    public function resetPassword($token)
    {
        return "🔑 This is where you'd show the reset form. Token: " . esc($token);
    }
}

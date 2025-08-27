<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\CaptchaController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        $captcha_controller = new CaptchaController();
        $data['captcha_image'] = $captcha_controller->generate();

        return view('auth/login',$data);
    }

    public function register()
    {
        $captcha_controller = new CaptchaController();
        $data['captcha_image'] = $captcha_controller->generate();
        
        return view('auth/register', $data);
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

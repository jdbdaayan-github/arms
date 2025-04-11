<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SessionController extends BaseController
{
    public function check()
    {
        $session = session();

        return $this->response->setJSON([
            'active' => $session->has('logged_in') && $session->get('logged_in') === true
        ]);
    }
}

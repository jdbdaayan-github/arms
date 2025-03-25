<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Directorate;
use CodeIgniter\HTTP\ResponseInterface;

class DirectorateController extends BaseController
{
    public function index()
    {
        $directorate = new Directorate();
        $data['directorates'] = $directorate->getDirectorates();

        return view('pages/directorates/directorateList', $data);
    }

    public function create()
    {
        $directorate = new Directorate();

        if($this->request->getMethod()=='POST')
        {
            $data = $this->request->getPost(['directorateCode', 'directorateName']);

            $rules = [
                'directorateCode' => 'required|is_unique[directorates.directorateCode]',
                'directorateName' => 'required',
            ];

            if(!$this->validate($rules))
            {
                return $this->validator;
            }

            $directorate->save($data);

            return redirect()->to('/directorates')->with('success', 'Directorate Created Successfully');
        }

        return view('pages/directorates/directorateCreate');
    }
}

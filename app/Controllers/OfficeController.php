<?php

namespace App\Controllers;

use App\Models\OfficeModel;
use App\Models\DirectorateModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OfficeController extends BaseController
{
    public function index()
    {
        return view("pages/offices/index");
    }

    public function getOfficesData()
    {
        $officeModel = new OfficeModel();
        $offices = $officeModel->getOffices();
        $data = [];
        foreach ($offices as $office) {
            $data[] = [
                'code'=> $office["code"],
                'name'=> $office["name"],
                'directorate_code' => $office['directorate_code'],
                'actions' => 
                    '<a href="' . base_url('permissions/edit/' . $office['id']) . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a> 
                    <button class="btn btn-danger btn-sm delete-btn" data-permission-id="' . $office['id'] . '" data-permission-name="' . $office['code'] . '">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>'
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }

    public function create()
    {
        $directorate_model = new DirectorateModel();
        $directorates = $directorate_model->getDirectorates();

        return view("pages/offices/officecreate", compact("directorates"));
    }

    public function store()
    {
        $rules = [
            "office_code" => "required|is_unique[offices.code]",
            "office_name"=> "required",
            "directorate_id"=> "required",
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with("errors",$this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('office_code'),
            'name'=> $this->request->getPost('office_name'),
            'directorate_id' => $this->request->getPost('directorate_id'),
        ];

        $office_model = new OfficeModel();

        if($office_model->addOffice($data))
        {
            return redirect()->to('offices')->with('success','Office added successfully');
        }
        
    }
}

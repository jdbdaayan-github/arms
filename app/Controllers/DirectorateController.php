<?php

namespace App\Controllers;

use App\Models\OfficeModel;
use App\Models\DirectorateModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DirectorateController extends BaseController
{
    public function index()
    {

        return view("pages/directorates/index");
    }

    public function getDirectoratesData()
    {
        if ($this->request->isAJAX()) {
            $directorateModel = new DirectorateModel();
            $directorates = $directorateModel->getDirectorates();

            $data = [];

            foreach ($directorates as $dir) {
                $actions = '
                    <a href="' . base_url('directorates/view/' . $dir['id']) . '" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                    <a href="' . base_url('directorates/edit/' . $dir['id']) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" 
                        data-directorate-id="' . $dir['id'] . '" 
                        data-directorate-name="' . esc($dir['name']) . '">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                ';

                $data[] = [
                    'code' => esc($dir['code']),
                    'name' => esc($dir['name']),
                    'actions' => $actions,
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        }

        // Not an AJAX request
        return redirect()->back();
    }


    public function create()
    {
        return view("pages/directorates/directoratecreate");
    }

    public function store()
    {
        $rules = [
            "code"=> "required|is_unique[directorates.code]",
            "name" => "required"
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }

        $data = [
            "code" => $this->request->getPost("code"),
            "name"=> $this->request->getPost("name"),
        ];

        $directorate_model = new DirectorateModel();
        $directorate_model->addDirectorate($data);

        return redirect()->to("directorates")->with("success","Directorate added successfully");
    }

    public function edit($id)
    {
        $directorate_model = new DirectorateModel();
        $directorate = $directorate_model->getDirectorate($id);

        return view("pages/directorates/directorateedit", ["directorate"=> $directorate]);
    }

    public function getOfficesbyID()
    {
        $directorateId = $this->request->getVar('directorate_id');
    
        // Assuming you have a model for offices
        $officeModel = new OfficeModel();
        $offices = $officeModel->where('directorate_id', $directorateId)->findAll();
    
        // Return the offices as JSON
        return $this->response->setJSON(['offices' => $offices]);
    }
}

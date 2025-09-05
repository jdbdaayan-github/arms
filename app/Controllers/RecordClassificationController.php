<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecordClassification;
use CodeIgniter\HTTP\ResponseInterface;

class RecordClassificationController extends BaseController
{
    protected $rec_classification_model;


    public function __construct()
    {
        $this->rec_classification_model = new RecordClassification();
    }
    public function index()
    {
        return view('pages/classifications/index');
    }

    public function ajaxClassificationsData()
    {
        $classifications = $this->rec_classification_model->getClassifications();

        return $this->response->setJSON($classifications);
    }

    public function create()
    {
        return view('pages/classifications/create');
    }

    public function store()
    {
        $rules = [
            'code' => [
                'rules'  => "required|max_length[50]|is_unique[record_classifications.code]",
                'errors' => [
                    'required'   => 'Classification Code is required.',
                    'max_length' => 'Classification Code cannot exceed 50 characters.',
                    'is_unique'  => 'This Classification Code already exists.',
                ],
            ],
            'name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Classification Name is required.',
                    'max_length' => 'Classification Name cannot exceed 100 characters.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
        ];

        if (!$this->rec_classification_model->saveClassification($data)) {
            return redirect()->to('classifications')->with('error', 'An unexpected error occurred. Please try again later.');
        }

        return redirect()->to('classifications')->with('success', 'Record classification added successfully!');
    }

    public function edit($id)
    {
        $classification = $this->rec_classification_model->getClassificationById($id);
        return view('pages/classifications/edit', ['classification' => $classification]);
    }

    public function update($id)
    {
        $rules = [
            'code' => [
                'rules'  => "required|max_length[50]|is_unique[record_classifications.code, id, {$id}]",
                'errors' => [
                    'required'   => 'Classification Code is required.',
                    'max_length' => 'Classification Code cannot exceed 50 characters.',
                    'is_unique'  => 'This Classification Code already exists.',
                ],
            ],
            'name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Classification Name is required.',
                    'max_length' => 'Classification Name cannot exceed 100 characters.',
                ],
            ],
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
        ];

        if(!$this->rec_classification_model->updateClassification($id, $data))
        {
            return redirect()->to('classifications')->with('error', 'An unexpected error occurred. Please try again later.');
        }

        return redirect()->to('classifications')->with('success', 'Record classification updated successfully!');
    }
}

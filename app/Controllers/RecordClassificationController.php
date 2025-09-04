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
        //
    }

    public function edit($id)
    {
        $classification = $this->rec_classification_model->getClassificationById($id);
        return view('pages/classifications/edit', ['classification' => $classification]);
    }
}

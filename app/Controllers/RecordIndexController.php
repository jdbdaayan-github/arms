<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecordIndex;
use CodeIgniter\HTTP\ResponseInterface;

class RecordIndexController extends BaseController
{
    protected $rec_indexes_model;

    public function __construct()
    {
        $this->rec_indexes_model = new RecordIndex();
    }

    public function index()
    {
        return view('pages/indexes/index');
    }

    public function ajaxRecordIndexesData()
    {
        $indexes = $this->rec_indexes_model->getIndexesList();

        return $this->response->setJSON($indexes);
    }

    public function create()
    {
        return view('pages/indexes/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|max_length[100]|is_unique[record_indexes.name]',
            'type' => 'required',
            'length' => 'required|max_length[2]'
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'length' => $this->request->getPost('length'),
        ];

        $this->rec_indexes_model->saveRecIndex($data);

        return redirect()->to('indexes')->with('success', 'Created index successfully!');
    }

    public function edit($id)
    {
        $index = $this->rec_indexes_model->getRecordIndexByID($id);
        return view('pages/indexes/edit', ['index' => $index]);
    }

    public function update($id)
    {
        //
    }
}

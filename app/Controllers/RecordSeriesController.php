<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecordClassification;
use App\Models\RecordSeries;
use CodeIgniter\HTTP\ResponseInterface;

class RecordSeriesController extends BaseController
{
    protected $rec_series_model;
    protected $rec_class_model;

    public function __construct()
    {
        $this->rec_series_model = new RecordSeries();
        $this->rec_class_model = new RecordClassification();
    }

    public function index()
    {
        return view('pages/series/index');
    }

    public function ajaxRecordSeriesData()
    {
        $rec_series = $this->rec_series_model->getSeries();

        return $this->response->setJSON($rec_series);
    }

    public function create()
    {
        $classifications = $this->rec_class_model->getClassifications();
        return view('pages/series/create', ['classifications' => $classifications]);
    }

    public function store()
    {
        $rules = [
            'code' => 'required|is_unique[record_series.code]|max_length[20]',
            'name' => 'required|is_unique[record_series.name]|max_length[100]',
            'classification_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'classification_id' => $this->request->getPost('classification_id')
        ];

        $series_id = $this->rec_series_model->insertSeries($data);

        audit_log('CREATE', 'record series', $series_id, null, $data, 'created record series ' . $data['name']);

        return redirect()->to('series')->with('success', 'Created record series successfully!');
    }

    public function edit($id)
    {
        $data['series'] = $this->rec_series_model->getSeriesById($id);
        $data['classifications'] = $this->rec_class_model->getClassifications();

        return view('pages/series/edit', $data);
    }

    public function update($id)
    {
        $old = $this->rec_series_model->getSeriesById($id);

        $rules = [
            'code' => [
                'rules' => "required|is_unique[record_series.code,id,{$id}]",
                'label' => 'Code'
            ],
            'name' => [
                'rules' => "required|is_unique[record_series.name,id,{$id}]",
                'label' => 'Name'
            ],
            'classification_id' => [
                'rules' => 'required',
                'label' => 'Classification'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'classification_id' => $this->request->getPost('classification_id')
        ];

        $updatedData = [];
        $oldData = [];
        foreach ($data as $key => $value) {
            if (isset($old->$key) && $old->$key != $value) {
                $updatedData[$key] = $value;
                $oldData[$key] = $old->$key;
            }
        }
        if (empty($updatedData)) {
            return redirect()->to('series')->with('info', 'No changes detected.');
        }

        if (!$this->rec_series_model->updateSeries($id, $data)) {
            return redirect()->to('series')->with('error', 'An unexpected error occurred. Please try again later.');
        }

        audit_log('UPDATE', 'record series', $id, $oldData, $updatedData, 'updated record series from "' . json_encode($oldData) . '" to "' . json_encode($updatedData) . '"');

        return redirect()->to('series')->with('success', 'Record series updates successfully!');
    }

    public function delete($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

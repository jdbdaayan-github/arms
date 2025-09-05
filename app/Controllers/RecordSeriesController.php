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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
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

<?php

namespace App\Controllers;

use App\Models\Record;
use App\Models\RecordIndex;
use App\Controllers\BaseController;
use App\Models\RecordSeries;
use CodeIgniter\HTTP\ResponseInterface;

class RecordController extends BaseController
{
    protected $record_model;
    protected $record_series_model;
    protected $record_index_model;

    public function __construct()
    {
        $this->record_model = new Record();
        $this->record_series_model = new RecordSeries();
        $this->record_index_model = new RecordIndex();
    }
    public function index()
    {
        return view('pages/records/index');
    }

    public function create()
    {
        $series = $this->record_series_model->getSeries();
        return view('pages/records/create', ['series' => $series]);
    }

    public function getIndexes($category_id)
    {
        $indexes = $this->record_index_model->getSeriesIndexesById($category_id);

        return $this->response->setJSON($indexes);
    }

    public function store()
    {
        //
    }
}

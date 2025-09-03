<?php

namespace App\Controllers;

use App\Models\Record;
use App\Models\RecordIndex;
use App\Models\RecordCategory;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RecordController extends BaseController
{
    protected $record_model;
    protected $record_category_model;
    protected $record_index_model;

    public function __construct()
    {
        $this->record_model = new Record();
        $this->record_category_model = new RecordCategory();
        $this->record_index_model = new RecordIndex();
    }
    public function index()
    {
        return view('pages/records/index');
    }

    public function create()
    {
        $categories = $this->record_category_model->getCategories();
        return view('pages/records/create', ['categories' => $categories]);
    }

    public function getIndexes($category_id)
    {
        $indexes = $this->record_index_model->getCategoryIndexesById($category_id);

        return $this->response->setJSON($indexes);
    }

    public function store()
    {
        //
    }
}

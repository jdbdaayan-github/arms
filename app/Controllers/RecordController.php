<?php

namespace App\Controllers;

use App\Models\Record;
use App\Models\RecordIndex;
use App\Models\RecordSeries;
use App\Models\RecordFileVersion;
use App\Models\RecordSeriesIndex;
use App\Controllers\BaseController;
use App\Models\RecordIndexValue;
use CodeIgniter\HTTP\ResponseInterface;

class RecordController extends BaseController
{
    protected $record_model;
    protected $record_series_model;
    protected $record_index_model;
    protected $record_file_version_model;
    protected $record_index_value;

    public function __construct()
    {
        $this->record_model = new Record();
        $this->record_series_model = new RecordSeries();
        $this->record_index_model = new RecordIndex();
        $this->record_file_version_model = new RecordFileVersion();
        $this->record_index_value = new RecordIndexValue();
    }

    public function index()
    {
        $recordModel = new \App\Models\Record();

        // Get request params
        $search     = $this->request->getGet('search');
        $perPage    = (int) $this->request->getGet('per_page') ?: 10; // default 10
        $page       = (int) $this->request->getGet('page') ?: 1;

        // Build query
        $builder = $recordModel;
        if ($search) {
            $builder = $builder->like('title', $search);
        }

        // Get paginated results
        $records = $builder->paginate($perPage, 'default', $page);
        $pager   = $builder->pager;

        return view('pages/records/index', [
            'records' => $records,
            'pager'   => $pager,
            'search'  => $search,
            'perPage' => $perPage,
        ]);
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
        $rules = [
            'record_file' => [
                'label' => 'Record File',
                'rules' => 'uploaded[record_file]'
                    . '|ext_in[record_file,pdf]'
                    . '|mime_in[record_file,application/pdf]'
                    . '|max_size[record_file,10240]', // 10MB
            ],
            'title'          => 'required',
            'confidentiality' => 'permit_empty',
            'series'         => 'required',
            'record_date'    => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $uploadPath = WRITEPATH . 'uploads/records/';
        if (! is_dir($uploadPath)) {
            if (! mkdir($uploadPath, 0777, true) && ! is_dir($uploadPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadPath));
            }
        }

        if (! is_writable($uploadPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" is not writable', $uploadPath));
        }

        $file = $this->request->getFile('record_file');
        $newName = null;

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
        }

        $record_data = [
            'title'        => $this->request->getPost('title'),
            'confidential' => $this->request->getPost('confidentiality'),
            'series_id'    => $this->request->getPost('series'),
            'record_date'  => $this->request->getPost('record_date'),
            'created_by'   => session()->get('user_id'),
        ];

        $record_id = $this->record_model->insertRecord($record_data);

        if ($record_id) {
            // save file version
            $record_version_data = [
                'record_id'      => $record_id,
                'user_id'        => session()->get('user_id'),
                'filename'       => $file->getClientName(), // original uploaded filename
                'randomfilename' => $newName,               // stored filename
            ];
            $this->record_file_version_model->insertRecordFileVersion($record_version_data);

            // save indexes
            $indexes = $this->request->getPost('indexes');
            if ($indexes && is_array($indexes)) {
                foreach ($indexes as $indexId => $value) {
                    $index_values = [
                        'record_id' => $record_id,
                        'index_id'  => $indexId,
                        'value'     => $value,
                    ];
                    $this->record_index_value->insertRecordIndexValue($index_values);
                }
            }

            $log_data = [
                'record'       => $record_data,
                'file_version' => $record_version_data,
                'indexes'      => $indexes ?? [],
            ];

            audit_log(
                'CREATE',                // action
                'records',               // module/table name
                $record_id,              // primary id
                null,                    // no old data on create
                $log_data,               // full new data
                session()->get('user_id') // actor
            );
        }

        return redirect()->to('/records')->with('success', $record_id);
    }


    public function show($id)
    {
        $indexes = $this->record_index_value->getRecordIndexValues($id);
        $record = $this->record_model->getRecordById($id);
        $versions = $this->record_file_version_model->getVersionByRecordId($id);

        return view('pages/records/view', ['record' => $record, 'versions' => $versions, 'indexes' => $indexes]);
    }
}

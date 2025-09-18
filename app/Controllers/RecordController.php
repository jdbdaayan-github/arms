<?php

namespace App\Controllers;

use App\Models\Record;
use App\Models\Settings;
use App\Models\RecordIndex;
use App\Models\RecordBorrow;
use App\Models\RecordSeries;
use App\Models\RecordHistory;
use App\Models\RecordIndexValue;
use App\Models\RecordFileVersion;
use App\Models\RecordSeriesIndex;
use App\Controllers\BaseController;
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

        if(hasRole('Contributor'))
        {
            $builder = $builder->where('created_by',session()->get('user_id'));
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

    public function approval()
    {
        $search  = $this->request->getGet('search');
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $page    = (int) $this->request->getGet('page') ?: 1;

        // Make sure getForApprovalData() returns a Builder object
        $builder = $this->record_model->getForApprovalData(); // should return Builder
        if ($search) {
            $builder = $builder->like('title', $search);
        }

        $records = $builder->paginate($perPage, 'default', $page); // always array
        $pager   = $builder->pager;

        // Ensure $records is never null
        $records = $records ?? [];

        return view('pages/records/approval', [
            'records' => $records,
            'pager'   => $pager,
            'search'  => $search,
            'perPage' => $perPage,
        ]);
    }

    public function archival()
    {
        $search  = $this->request->getGet('search');
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $page    = (int) $this->request->getGet('page') ?: 1;

        $pendingForArchival = $this->record_model->getForArchivalData();

        $pendingForArchivalCount = $pendingForArchival->countAllResults();
        // Make sure getForApprovalData() returns a Builder object
        $builder = $pendingForArchival; // should return Builder
        if ($search) {
            $builder = $builder->like('title', $search);
        }

        $records = $builder->paginate($perPage, 'default', $page); // always array
        $pager   = $builder->pager;

        // Ensure $records is never null
        $records = $records ?? [];

        return view('pages/records/archive', [
            'records' => $records,
            'pager'   => $pager,
            'search'  => $search,
            'perPage' => $perPage,
            'pendingForArchivalCount' => $pendingForArchivalCount,
        ]);
    }

    public function borrow()
    {
        return view('pages/records/borrow');
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
        $settings_model = new Settings();

        $validSize = $settings_model->getValidFileSize('maxfilesize');

        $rules = [
            'record_file' => [
                'label' => 'Record File',
                'rules' => 'uploaded[record_file]'
                    . '|ext_in[record_file,pdf]'
                    . '|mime_in[record_file,application/pdf]'
                    . `|max_size[record_file,{$validSize}]`,
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

            audit_log('CREATE', 'records', $record_id, null, $log_data, 'create record ' . $record_data['title']);
            record_hisory_log('CREATED', $record_id, 'Record created and submitted for approval');
        }

        return redirect()->to('/records')->with('success', $record_id);
    }


    public function show($id)
    {
        $history_model = new RecordHistory();
        $data['histories'] = $history_model->getHistoryByRecordId($id);
        $data['indexes'] = $this->record_index_value->getRecordIndexValues($id);
        $data['record'] = $this->record_model->getRecordById($id);
        $data['versions'] = $this->record_file_version_model->getVersionByRecordId($id);

        return view('pages/records/view', $data);
    }

    public function workflow($id)
    {
        return view('pages/records/workflow');
    }

    public function request($id)
    {
        $data['record'] = $this->record_model->getRecordById($id);
        return view('pages/records/request', $data);
    }

    public function submitRequest($id)
    {
        $borrow_model = new RecordBorrow();
        
        $rules = [
            'due_date' => 'permit_empty',
            'remarks' => 'required',
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'record_id' => $id,
            'due_date' => $this->request->getPost('due_date'),
            'remarks' => $this->request->getPost('remarks'),
            'user_id' => session()->get('user_id'),
        ];

        $borrow_model->addRequest($data);

        return redirect()->to('records')->with('success', 'Record requested successfully!');


    }
}
 
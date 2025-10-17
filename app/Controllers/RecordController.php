<?php

namespace App\Controllers;

use App\Models\Record;
use App\Models\Settings;
use App\Models\RecordIndex;
use App\Models\RecordBorrow;
use App\Models\RecordSeries;
use App\Models\RecordStatus;
use App\Models\RecordHistory;
use App\Models\RecordRequest;
use App\Models\RecordIndexValue;
use App\Models\RecordFileVersion;
use App\Models\RecordRequestType;
use App\Models\RecordSeriesIndex;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RecordController extends BaseController
{
    protected $record_model;
    protected $record_series_model;
    protected $record_series_index_model;
    protected $record_index_model;
    protected $record_file_version_model;
    protected $record_index_value;
    protected $record_request;
    protected $record_request_type;

    public function __construct()
    {
        $this->record_model = new Record();
        $this->record_series_model = new RecordSeries();
        $this->record_index_model = new RecordIndex();
        $this->record_series_index_model = new RecordSeriesIndex();
        $this->record_file_version_model = new RecordFileVersion();
        $this->record_index_value = new RecordIndexValue();
        $this->record_request = new RecordRequest();
        $this->record_request_type = new RecordRequestType();
    }

    public function index()
    {
        $status_model = new RecordStatus();
        $statuses = $status_model->getAllStatus();
        $recordModel = new Record();

        // Get request params
        $status_id = $this->request->getGet('status_id');
        $search     = $this->request->getGet('search');
        $perPage    = (int) $this->request->getGet('per_page') ?: 10; // default 10
        $page       = (int) $this->request->getGet('page') ?: 1;

        $builder = $this->record_model->getRecords();
        if ($search) {
            $builder = $builder->like('title', $search);
        }

        //filter record per status
        if ($status_id) {
            $builder = $builder->where('status_id', $status_id);
        }

        /**Contributor can view his records created only
        if (session()->get('role') == "Contributor") {
            $builder = $builder->where('created_by', session()->get('user_id'));
        }*/

        // Get paginated results
        $records = $builder->paginate($perPage, 'default', $page);
        $pager   = $builder->pager;

        return view('pages/records/index', [
            'records' => $records,
            'pager'   => $pager,
            'search'  => $search,
            'perPage' => $perPage,
            'statuses' => $statuses,
            'status_id' => $status_id
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

    public function approveRecord($id)
    {
        $data = [
            'status_id' => 3,
        ];

        if ($this->record_model->update($id, $data)) {
            return redirect()->to('records/approval')->with('success', 'Records approved successfully!');
        }
    }

    public function archival()
    {
        $search  = $this->request->getGet('search');
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $page    = (int) $this->request->getGet('page') ?: 1;

        // === ARCHIVED RECORDS ===
        $builderArchived = $this->record_model->getArchivedData();
        if ($search) {
            $builderArchived = $builderArchived->like('title', $search);
        }

        $recordsArchived = $builderArchived->paginate($perPage, 'archived', $page);
        $pagerArchived   = $builderArchived->pager;

        // === FOR ARCHIVAL RECORDS ===
        $builderForArchival = $this->record_model->getForArchivalData();
        if ($search) {
            $builderForArchival = $builderForArchival->like('title', $search);
        }

        $recordsForArchival = $builderForArchival->paginate($perPage, 'for_archival', $page);
        $pagerForArchival   = $builderForArchival->pager;

        $pendingForArchivalCount = $this->record_model->countPendingArchival();

        return view('pages/records/archive', [
            'recordsArchived' => $recordsArchived ?? [],
            'recordsForArchival' => $recordsForArchival ?? [],
            'pagerArchived' => $pagerArchived,
            'pagerForArchival' => $pagerForArchival,
            'search' => $search,
            'perPage' => $perPage,
            'pendingForArchivalCount' => $pendingForArchivalCount,
        ]);
    }

    public function archive($id)
    {
        $data = [
            'status_id' => 4,
            'archived_by' => session()->get('user_id'),
            'archived_at' => date('Y-m-d H:i:s'),
        ];
        //dd($data);

        if ($this->record_model->update($id, $data)) {
            return redirect()->to('records/archival')->with('success', 'Records archived successfully!');
        }
    }


    public function create()
    {
        if (hasRole('Administrator') || hasPermission('records.create') || hasRole('Contributor')) {
            $series = $this->record_series_model->getSeries();
            return view('pages/records/create', ['series' => $series]);
        }

        return $this->response->setStatusCode(403)
            ->setBody(view('errors/html/error_403', [
                'message' => 'You do not have permission to access this page.'
            ]));
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

        //$refNumber = 'REC-' . date('Ymd') . '-' . str_pad(uniqid(), 10, '0', STR_PAD_LEFT);
        $isDraft = (bool) $this->request->getPost('save_as_draft');
        $record_data = [
            'title'        => $this->request->getPost('title'),
            'confidential' => $this->request->getPost('confidentiality'),
            'series_id'    => $this->request->getPost('series'),
            'record_date'  => $this->request->getPost('record_date'),
            'created_by'   => session()->get('user_id'),
        ];

        if ($isDraft) {
            $record_data['status_id'] = 1;
        }

        $record_id = $this->record_model->insertRecord($record_data);

        if ($record_id) {

            //save insert unique record ref_number
            // $refNumber = 'REC-' . date('Ymd') . '-' . str_pad($record_id, 6, '0', STR_PAD_LEFT);
            // $refData =  ['ref_number' => $refNumber];
            //dd($refData);
            //$this->record_model->update($record_id, $refData);

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

    public function edit($id)
    {
        $record = $this->record_model->find($id);

        // kunin lahat ng indexes ng series
        $indexes = $this->record_index_model->getSeriesIndexesById($record->series_id);

        // kunin yung saved values ng record na ito
        $recordIndexes = $this->record_index_value->getRecordIndexValues($id);

        // gawing associative array para madaling i-access sa view
        $indexValues = [];
        foreach ($recordIndexes as $ri) {
            $indexValues[$ri->index_id] = $ri->value;
        }

        return view('pages/records/edit', [
            'record' => $record,
            'series' => $this->record_series_model->getSeries(),
            'indexValues' => $indexValues, // ← importante
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function update($id)
    {
        //
    }
public function search()
{
    $filters = $this->request->getGet();
    $records = null;
    $indexes = [];

    $data['series'] = $this->record_series_model->findAll();
    $data['filters'] = $filters;

    // Load all indexes for the selected series
    if (!empty($filters['series'])) {
        $indexes = $this->record_series_index_model
            ->select('record_indexes.id, record_indexes.name, record_indexes.type, record_indexes.placeholder')
            ->join('record_indexes', 'record_indexes.id = record_series_indexes.record_index_id', 'left')
            ->where('record_series_indexes.record_series_id', $filters['series'])
            ->orderBy('record_indexes.id', 'ASC')
            ->get()
            ->getResult();
    }

    // Perform search only when form submitted
    if (!empty($filters)) {
        $builder = $this->record_model
            ->select('records.*, s.name AS series_name')
            ->join('record_series s', 's.id = records.series_id', 'left');

        // Keyword filter
        if (!empty($filters['keyword'])) {
            $builder->groupStart()
                ->like('records.title', $filters['keyword'])
                ->groupEnd();
        }

        // Series
        if (!empty($filters['series'])) {
            $builder->where('records.series_id', $filters['series']);
        }

        // Confidentiality
        if (isset($filters['confidentiality']) && $filters['confidentiality'] !== '') {
            $builder->where('records.confidential', $filters['confidentiality']);
        }

        // Date Range
        if (!empty($filters['date_from'])) {
            $builder->where('records.record_date >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $builder->where('records.record_date <=', $filters['date_to']);
        }

        // 🔍 Dynamic Index Filters (using record_index_values)
        if (!empty($filters['indexes']) && is_array($filters['indexes'])) {
            foreach ($filters['indexes'] as $indexId => $value) {
                if (trim($value) !== '') {
                    $alias = 'riv_' . $indexId;

                    $builder->join(
                        "record_index_values AS {$alias}",
                        "{$alias}.record_id = records.id AND {$alias}.index_id = " . (int)$indexId,
                        'left'
                    );

                    $builder->like("{$alias}.value", $value);
                }
            }
        }

        $builder->groupBy('records.id');
        $records = $builder->get()->getResult();
    }

    $data['indexes'] = $indexes;
    $data['records'] = $records;

    return view('pages/records/search', $data);
}

    public function workflow($id)
    {
        return view('pages/records/workflow');
    }

    public function delete($id)
    {
        $this->record_model->delete($id);
        return redirect()->to('records')->with('success', 'Record soft deleted, files remain.');
    }

    public function purge($id)
    {
        $recordFiles = $this->record_file_version_model->getVersionByRecordId($id);

        if ($recordFiles) {
            foreach ($recordFiles as $file) {
                $filePath = WRITEPATH . 'uploads/records/' . $file['randomfilename'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        return redirect()->to('records')->with('success', 'Files deleted, data remains.');
    }

    public function forceDelete($id)
    {

        $recordFiles = $this->record_file_version_model->getVersionByRecordId($id);
        if ($recordFiles) {
            foreach ($recordFiles as $file) {
                $filePath = WRITEPATH . 'uploads/records/' . $file['randomfilename'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $this->record_file_version_model->deleteFiles($id);
            $this->record_model->forceDelete($id);
        }
        return redirect()->to('records')->with('success', 'Record deleted successfully!');
    }
}

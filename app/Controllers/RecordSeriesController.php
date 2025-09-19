<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecordClassification;
use App\Models\RecordIndex;
use App\Models\RecordSeries;
use App\Models\RecordSeriesIndex;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class RecordSeriesController
 *
 * Handles CRUD operations and index assignments for Record Series.
 * 
 * Responsibilities:
 * - Manage creation, editing, updating, and listing of record series
 * - Handle linking/unlinking of indexes to record series
 * - Provide AJAX endpoints for data consumption
 */
class RecordSeriesController extends BaseController
{
    protected $rec_series_model;
    protected $rec_class_model;
    protected $rec_index_model;
    protected $rec_series_index_model;

    public function __construct()
    {
        // Initialize models used by this controller
        $this->rec_series_model = new RecordSeries();
        $this->rec_class_model = new RecordClassification();
        $this->rec_index_model = new RecordIndex();
        $this->rec_series_index_model = new RecordSeriesIndex();
    }

    /**
     * Display list of record series.
     */
    public function index()
    {
        return view('pages/series/index');
    }

    /**
     * Fetch record series data for AJAX requests.
     *
     * @return ResponseInterface JSON encoded list of record series
     */
    public function ajaxRecordSeriesData()
    {
        $rec_series = $this->rec_series_model->getSeries();
        return $this->response->setJSON($rec_series);
    }

    /**
     * Show the create form for a new record series.
     */
    public function create()
    {
        $classifications = $this->rec_class_model->getClassifications();
        return view('pages/series/create', ['classifications' => $classifications]);
    }

    /**
     * Store a new record series.
     *
     * @return ResponseInterface|RedirectResponse
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'code' => 'required|is_unique[record_series.code]|max_length[20]',
            'name' => 'required|is_unique[record_series.name]|max_length[100]',
            'classification_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare data
        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'classification_id' => $this->request->getPost('classification_id')
        ];

        // Insert new record series
        $series_id = $this->rec_series_model->insertSeries($data);

        // Audit log
        audit_log('CREATE', 'record series', $series_id, null, $data, 'created record series ' . $data['name']);

        return redirect()->to('series')->with('success', 'Created record series successfully!');
    }

    /**
     * Show the edit form for an existing record series.
     *
     * @param int $id Record series ID
     */
    public function edit($id)
    {
        $data['series'] = $this->rec_series_model->getSeriesById($id);
        $data['classifications'] = $this->rec_class_model->getClassifications();

        return view('pages/series/edit', $data);
    }

    /**
     * Update an existing record series.
     *
     * @param int $id Record series ID
     * @return ResponseInterface|RedirectResponse
     */
    public function update($id)
    {
        $old = $this->rec_series_model->getSeriesById($id);

        // Validation rules with exception for current record
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

        // Prepare updated data
        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'classification_id' => $this->request->getPost('classification_id')
        ];

        // Detect changes between old and new data
        $updatedData = [];
        $oldData = [];
        foreach ($data as $key => $value) {
            if (isset($old->$key) && $old->$key != $value) {
                $updatedData[$key] = $value;
                $oldData[$key] = $old->$key;
            }
        }

        // If no changes, exit gracefully
        if (empty($updatedData)) {
            return redirect()->to('series')->with('info', 'No changes detected.');
        }

        // Save updates
        if (!$this->rec_series_model->updateSeries($id, $data)) {
            return redirect()->to('series')->with('error', 'An unexpected error occurred. Please try again later.');
        }

        // Audit log of changes
        audit_log(
            'UPDATE',
            'record series',
            $id,
            $oldData,
            $updatedData,
            'updated record series from "' . json_encode($oldData) . '" to "' . json_encode($updatedData) . '"'
        );

        return redirect()->to('series')->with('success', 'Record series updates successfully!');
    }

    /**
     * Soft delete a record series (optional future use).
     */
    public function delete($id)
    {
        // TODO: Implement soft delete logic
    }

    /**
     * Permanently delete a record series (optional future use).
     */
    public function destroy($id)
    {
        // TODO: Implement hard delete logic
    }

    /**
     * Show and manage indexes assigned to a record series.
     *
     * @param int $id Record series ID
     */
    public function indexes($id)
    {
        $data['series'] = $this->rec_series_model->getSeriesById($id);

        // Fetch indexes assigned to this series
        $indexes = $this->rec_series_model->getSeriesIndexesBySeriesId($id);

        // Extract assigned index IDs
        $assignedIndexes = array_column($indexes, 'record_index_id');

        // Fetch indexes not yet assigned to this series
        $data['availableIndexes'] = $this->rec_index_model->whereNotIn('id', $assignedIndexes ?: [0])->get()->getResult();

        return view('pages/series/series_indexes', $data);
    }

    /**
     * Fetch assigned indexes for a series (AJAX).
     *
     * @param int $id Record series ID
     * @return ResponseInterface
     */
    public function indexesData($id)
    {
        $indexes = $this->rec_series_model->getSeriesIndexesBySeriesId($id);
        return $this->response->setJSON($indexes);
    }

    /**
     * Assign an index to a record series.
     *
     * @param int $id Record series ID
     * @return ResponseInterface|RedirectResponse
     */
    public function addIndex($id)
    {
        $data = [
            'record_series_id' => $id,
            'record_index_id' => $this->request->getPost('record_index_id'),
        ];

        $this->rec_series_index_model->addIndexToSeries($data);

        return redirect()->to('series/index/' . $id)->with('success', 'Added new index successfully!');
    }

    /**
     * Remove an index from a record series.
     *
     * @param int $series_id Record series ID
     * @return ResponseInterface JSON status response
     */
    public function removeIndex($series_id)
    {
        $index_id = $this->request->getPost('index_id');

        $deleted = $this->rec_series_index_model->removeIndexToSeries($series_id, $index_id);

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}

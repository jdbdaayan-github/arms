<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RecordIndex;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * RecordIndexController
 * 
 * Controller for managing record indexes (metadata fields).
 * Provides basic CRUD operations for handling indexes used 
 * in record classification.
 */
class RecordIndexController extends BaseController
{
    protected $rec_indexes_model;

    public function __construct()
    {
        // Load the RecordIndex model
        $this->rec_indexes_model = new RecordIndex();
    }

    /**
     * Display the main list page of record indexes.
     */
    public function index()
    {
        return view('pages/indexes/index');
    }

    /**
     * Return list of record indexes as JSON (for AJAX/datatable use).
     */
    public function ajaxRecordIndexesData()
    {
        $indexes = $this->rec_indexes_model->getIndexesList();
        return $this->response->setJSON($indexes);
    }

    /**
     * Show form for creating a new record index.
     */
    public function create()
    {
        return view('pages/indexes/create');
    }

    /**
     * Store a new record index in the database.
     */
    public function store()
    {
        // Validation rules for input fields
        $rules = [
            'name'       => 'required|max_length[100]|is_unique[record_indexes.name]',
            'type'       => 'required',
            'length'     => 'required|max_length[2]',
            'placeholder'=> 'permit_empty|max_length[50]',
            'required'   => 'required'
        ];

        // If validation fails, return to form with errors
        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare data for insertion
        $data = [
            'name'        => $this->request->getPost('name'),
            'type'        => $this->request->getPost('type'),
            'length'      => $this->request->getPost('length'),
            'placeholder' => $this->request->getPost('placeholder'),
        ];

        // Save the new record index
        $this->rec_indexes_model->saveRecIndex($data);

        // Redirect with success message
        return redirect()->to('indexes')->with('success', 'Created index successfully!');
    }

    /**
     * Show edit form for an existing record index.
     * 
     * @param int $id
     */
    public function edit($id)
    {
        $index = $this->rec_indexes_model->getRecordIndexByID($id);
        return view('pages/indexes/edit', ['index' => $index]);
    }

    /**
     * Update an existing record index.
     * 
     * (Validation rules are defined but the update logic is not yet implemented.)
     * 
     * @param int $id
     */
    public function update($id)
    {
        // Validation rules for updating existing index
        $rules = [
            'name' => [
                'label' => 'Index Name',
                'rules' => "required|max_length[100]|is_unique[record_indexes.name,id,{$id}]",
                'errors' => [
                    'required'   => 'The Index Name field is required.',
                    'max_length' => 'The Index Name cannot exceed 100 characters.',
                    'is_unique'  => 'This Index Name already exists.'
                ]
            ],
            'type' => [
                'label' => 'Type',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Type field is required.'
                ]
            ],
            'length' => [
                'label' => 'Length',
                'rules' => 'required|max_length[3]',
                'errors' => [
                    'required'   => 'The length field is required.',
                    'max_length' => 'The length field cannot exceed 3 characters.'
                ]
            ],
            'placeholder' => [
                'label' => 'Placeholder',
                'rules' => 'permit_empty|max_length[50]',
                'errors' => [
                    'max_length' => 'The placeholder cannot exceed 50 characters.'
                ]
            ],
            'required' => [
                'label' => 'Required',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The required field is required.'
                ]
            ]
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'length' => $this->request->getPost('length'),
            'placeholder' => $this->request->getPost('placeholder'),
            'required' => $this->request->getPost('required'),
        ];

        $this->rec_indexes_model->updateRecIndex($id, $data);

         return redirect()->to('indexes')->with('success', 'Updated index successfully!');
    }
}

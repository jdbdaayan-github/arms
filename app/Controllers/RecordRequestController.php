<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Record;
use App\Models\RecordRequest;
use App\Models\RecordRequestType;
use CodeIgniter\HTTP\ResponseInterface;

class RecordRequestController extends BaseController
{
    protected $record_request_model;
    protected $record_request_type;
    protected $record_model;

    public function __construct()
    {
        $this->record_request_model = new RecordRequest();
        $this->record_request_type = new RecordRequestType();
        $this->record_model = new Record();
    }
    public function index()
    {
        $search     = $this->request->getGet('search');
        $perPage    = (int) $this->request->getGet('per_page') ?: 10;
        $page       = (int) $this->request->getGet('page') ?: 1;

        // Make sure getForApprovalData() returns a Builder object
        $builder = $this->record_request_model->getAllRequest();
        if ($search) {
            $builder = $builder->like('title', $search);
        }

        $requests = $builder->paginate($perPage, 'default', $page); // always array
        $pager   = $builder->pager;

        // Ensure $records is never null
        $requests = $requests ?? [];

        return view('pages/records/requests', [
            'requests' => $requests,
            'pager'   => $pager,
            'search'  => $search,
            'perPage' => $perPage,
        ]);
    }

    public function request($id)
    {
        $data['req_type'] = $this->record_request_type->getAllRecordTypes();
        $data['record'] = $this->record_model->getRecordById($id);
        return view('pages/records/request', $data);
    }

    public function submitRequest($id)
    {
        $rules = [
            'request_type' => 'required',
            'due_date' => 'permit_empty',
            'remarks' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'record_id' => $id,
            'request_id' => $this->request->getPost('request_type'),
            'due_date' => $this->request->getPost('due_date'),
            'remarks' => $this->request->getPost('remarks'),
            'user_id' => session()->get('user_id'),
        ];

        $this->record_request_model->addRequest($data);

        return redirect()->to('records')->with('success', 'Record requested successfully!');
    }

    public function cancelRequest($id) {
        //
    }

    public function approveRequest($id) {
        //
    }

    public function disapproveRequest($id) {
        //
    }

    public function completeRequest($id) {
        //
    }


}

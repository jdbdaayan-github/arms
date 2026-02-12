<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Record;
use App\Models\RecordRequest;
use App\Models\RecordRequestType;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Expr\FuncCall;

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
            $builder = $builder->like('reference_no', $search);
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

    // Request per document
    public function request($id)
    {
        $data['req_type'] = $this->record_request_type->getAllRequestTypes();
        $data['record'] = $this->record_model->getRecordById($id);
        return view('pages/records/request', $data);
    }

    //Request for general
    public function request_new()
    {
        $data['req_type'] = $this->record_request_type->getAllRequestTypes();
        return view('pages/records/request_create', $data);
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

        return redirect()->to('records')->with('req_success', 'Record requested successfully!');
    }

    public function submitnewRequest()
    {
        $rules = [
            'description'   => 'required',
            'request_type'  => 'required',
            'remarks'       => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'description' => $this->request->getPost('description'),
            'request_id'  => $this->request->getPost('request_type'),
            'remarks'     => $this->request->getPost('remarks'),
            'user_id'     => session()->get('id'), // ✅ FIXED
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        // Insert first
        $insertId = $this->record_request_model->addRequest($data);

        if (!$insertId) {
            return redirect()->to('records/requests')
                ->with('error', 'Record request failed!');
        }

        // Generate YYYY-MM-XXXXXX
        $referenceNo = date('Y-m') . '-' . str_pad($insertId, 6, '0', STR_PAD_LEFT);

        // Update with formatted ID
        $this->record_request_model->updateRequest($insertId, [
            'reference_no' => $referenceNo
        ]);

        return redirect()->to('records/requests')
            ->with('success', 'Record requested successfully!');
    }

    public function edit($id)
    {
        $data['req_type'] = $this->record_request_type->getAllRequestTypes();
        $data['request'] = $this->record_request_model->getRequestById($id);
        return view('pages/records/request_edit', $data);
    }

    public function updateRequest($id)
    {
        $rules = [
            'description'   => 'required',
            'request_type'  => 'required',
            'remarks'       => 'required',
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'description' => $this->request->getPost('description'),
            'request_id' => $this->request->getPost('request_type'),
            'remarks' => $this->request->getPost('remarks')
        ];

        if(!$this->record_request_model->updateRequest($id, $data))
        {
            return redirect()->to('records/requests')->with('error', 'Unable to update request');
        }

        return redirect()->to('records/requests')->with('success', 'Request updated successfully!');
    }

    public function cancelRequest($id)
    {
        $data = [
            'status' => 'Cancelled',
        ];

        $this->record_request_model->updateRequest($id, $data);

    }

    public function approveRequest($id)
    {
        $data = [
            'status' => 'Ongoing',
        ];
        
        $this->record_request_model->updateRequest($id, $data);

        if(!$this->record_request_model->updateRequest($id, $data))
        {
            return redirect()->to('records/requests')->with('error', 'Unable to update request');
        }

        return redirect()->to('records/requests')->with('success', 'Request updated successfully!');
    }

    public function disapproveRequest($id)
    {
        $data = [
            'status' => 'Disapproved',
        ];
        
        $this->record_request_model->updateRequest($id, $data);

        if(!$this->record_request_model->updateRequest($id, $data))
        {
            return redirect()->to('records/requests')->with('error', 'Unable to update request');
        }

        return redirect()->to('records/requests')->with('success', 'Request updated successfully!');
    }

    public function completeRequest($id)
    {
        $data = [
            'status' => 'Completed',
        ];
        
        $this->record_request_model->updateRequest($id, $data);
    }

    public function request_view($id)
    {
        $data['request']  = $this->record_request_model->getRequestById($id);
        //dd($data);
        return view('pages/records/request_view', $data);
    }
}

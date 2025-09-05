<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permission;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Stmt\Return_;

class PermissionController extends BaseController
{
    protected $permission_model;

    public function __construct()
    {
        $this->permission_model = new Permission();
    }

    public function index()
    {
        return view('pages/permissions/index');
    }

    public function ajaxPermissionsData()
    {
        $permissions = $this->permission_model->getPermissions();

        return $this->response->setJSON($permissions);
    }

    public function create()
    {
        return view('pages/permissions/create');
    }

    public function store()
    {
        $rules = [
            'permission_name' => [
                'rules'  => "required|max_length[15]|is_unique[permissions.permission_name]",
                'errors' => [
                    'required'   => 'Permission Name is required.',
                    'max_length' => 'Permission Name cannot exceed 15 characters.',
                    'is_unique'  => 'This Permission Name already exists.',
                ],
            ],
            'description' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Description cannot exceed 100 characters.',
                ],
            ],
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'permission_name' => $this->request->getPost('permission_name'),
            'description' => $this->request->getPost('description'),
        ];

        $this->permission_model->addPermission($data);

        return redirect()->to('permissions')->with('success', 'Permission created successfully!');
    }

    public function edit($id)
    {

        $permission = $this->permission_model->getPermissionById($id);

        return view('pages/permissions/edit',['permission' => $permission]);
    }

    public function update($id)
    {
        $rules = [
            'permission_name' => [
                'rules'  => "required|max_length[50]|is_unique[permissions.permission_name,id,{$id}]",
                'errors' => [
                    'required'   => 'Permission Name is required.',
                    'max_length' => 'Permission Name cannot exceed 50 characters.',
                    'is_unique'  => 'This Permission Name already exists.',
                ],
            ],
            'description' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Description cannot exceed 100 characters.',
                ],
            ],
        ];

        if(!$this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'permission_name' => $this->request->getPost('permission_name'),
            'description' => $this->request->getPost('description'),
        ];

        if(!$this->permission_model->updatePermission($id, $data))
        {
            return redirect()->to('permissions')->with('error', 'An unexpected error occurred. Please try again later.');
        }

        return redirect()->to('permissions')->with('success', 'Permission updated successfully!');
    }
}

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
            'permission_name' => 'required|max_length[100]|is_unique[permissions.permission_name]',
            'description' => 'permit_empty|max_length[255]'
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
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use CodeIgniter\HTTP\ResponseInterface;

class RoleController extends BaseController
{
    protected $role_model;
    protected $role_permission_model;
    protected $permission_model;

    public function __construct()
    {
        $this->role_model = new Role();
        $this->role_permission_model = new RolePermission();
        $this->permission_model = new Permission();
    }

    public function index()
    {
        return view('pages/roles/index');
    }

    public function ajaxRolesData()
    {
        $roles = $this->role_model->getRoles();

        return $this->response->setJSON($roles);
    }

    public function create()
    {
        return view('pages/roles/create');
    }

    public function store()
    {
        $rules = [
            'role_name' => [
                'rules'  => 'required|max_length[20]|is_unique[roles.role_name]',
                'errors' => [
                    'required'   => 'Role Name is required.',
                    'max_length' => 'Role Name cannot exceed 20 characters.',
                    'is_unique'  => 'This Role Name already exists.',
                ],
            ],
            'description' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Description cannot exceed 100 characters.',
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'role_name' => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ];

        $insertedId = $this->role_model->saveRole($data);

        return redirect()->to('roles')->with('success', 'Role created successfully!');
    }

    public function edit($id)
    {
        $role = $this->role_model->getRoleById($id);

        return view('pages/roles/edit', ['role' => $role]);
    }

    public function update($id)
    {
        $rules = [
            'role_name' => [
                'rules'  => "required|max_length[15]|is_unique[roles.role_name,id,{$id}]",
                'errors' => [
                    'required'   => 'Role Name is required.',
                    'max_length' => 'Role Name cannot exceed 15 characters.',
                    'is_unique'  => 'This Role Name already exists.',
                ],
            ],
            'description' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Description cannot exceed 100 characters.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'role_name' => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ];

        if (!$this->role_model->updateRole($id, $data)) {
            return redirect()->to('roles')->with('error', 'An unexpected error occurred. Please try again later.');
        }
        
        return redirect()->to('roles')->with('success', 'Role updated successfully!');
    }

    public function rolePermissions($id)
    {
        $role = $this->role_model->getRoleById($id);

        $allPermissions = $this->permission_model->findAll();

        $assignedPermissions = $this->role_permission_model
            ->where('role_id', $id)
            ->findColumn('permission_id');

        foreach ($allPermissions as $key => $perm) {
            $allPermissions[$key]->assigned = in_array($perm->id, $assignedPermissions);
        }

        return view('pages/roles/role_permission', [
            'role' => $role,
            'permissions' => $allPermissions
        ]);
    }

    //Assigning Permissions to Role
    public function savePermissions($roleId)
    {

        $selectedPermissions = $this->request->getPost('permissions') ?? [];

        $this->role_permission_model->where('role_id', $roleId)->delete();

        foreach ($selectedPermissions as $permId) {
            $this->role_permission_model->insert([
                'role_id' => $roleId,
                'permission_id' => $permId
            ]);
        }

        return redirect()->to('roles/permissions/' . $roleId)->with('success', 'Permissions updated successfully!');
    }

    public function ajaxRolePermissionData($id)
    {
        $permissions = $this->role_permission_model->getPermissionsByRole($id);
        return $this->response->setJSON($permissions);
    }
}

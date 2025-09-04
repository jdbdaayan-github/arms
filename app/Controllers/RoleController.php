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

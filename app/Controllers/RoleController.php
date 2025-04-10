<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Controllers\BaseController;
use App\Models\RolePermissionModel;
use CodeIgniter\HTTP\ResponseInterface;

class RoleController extends BaseController
{
    public function index()
    {
        return view("pages/roles/index");
    }

    public function getRolesData()
    {
        $roles_model = new RoleModel();
        // Fetch roles data
        
        $roles = $roles_model->getRoles();

        // Prepare data for DataTables (AJAX)
        $data = [];
        
        foreach ($roles as $role) {
            $data[] = [
                'role_name' => $role['role_name'],
                'description' => $role['description'],  // Assuming you have a description column
                'actions' => 
                    '<button class="btn btn-sm btn-primary edit-btn" data-id="' . $role['id'] . '" data-toggle="tooltip" title="Edit Role">
                        <i class="fas fa-edit"></i> Edit
                    </button> '
                    . (in_array('superadmin', session()->get('roles')) ? 
                    ' <a href="' . base_url('roles/permissions/' . $role['id']) . '" class="btn btn-sm btn-info" data-toggle="tooltip" title="Manage Permissions">
                        <i class="fas fa-key"></i> Permissions
                    </a>' : '')
                    . (in_array('superadmin', session()->get('roles')) ? 
                        ' <button class="btn btn-sm btn-danger delete-btn" data-id="' . $role['id'] . '" data-name="' . $role['role_name'] . '" data-toggle="tooltip" title="Delete Role">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>' : '')
                    
            ];
            
        }

        // Return the JSON response
        return $this->response->setJSON(['data' => $data]);
    }

    public function permissions($role_id)
    {
        $roleModel = new RoleModel();
        $role = $roleModel->find($role_id);

        $permissionModel = new PermissionModel();
        $allPermissions = $permissionModel->getPermissions();

        $rolePermissionModel = new RolePermissionModel();
        $assignedPermissions = $rolePermissionModel
            ->select('permission_id')
            ->where('role_id', $role_id)
            ->findAll();

        $assignedIds = array_column($assignedPermissions, 'permission_id');

        // Filter out already assigned permissions
        $unassignedPermissions = array_filter($allPermissions, function ($perm) use ($assignedIds) {
            return !in_array($perm['id'], $assignedIds);
        });

        return view('pages/roles/role_permissions', [
            'role' => $role,
            'permissions' => $unassignedPermissions
        ]);


    }

    public function getRolePermissions($role_id)
    {
        // Initialize models
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();

        // Check if the role exists
        $role = $roleModel->find($role_id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found');
        }

        // Fetch the permissions associated with this role
        $permissions = $permissionModel
            ->join('role_permissions', 'role_permissions.permission_id = permissions.id')
            ->where('role_permissions.role_id', $role_id)
            ->findAll();

        // Prepare data for DataTable or frontend
        $data = [];
        foreach ($permissions as $permission) {
            $data[] = [
                'permission_name' => $permission['permission_name'],  // Assuming this column exists
                'description' => $permission['description'],  // Assuming you have a description column
                'actions' => 
                    '<button class="btn btn-sm btn-danger delete-permission-btn" data-id="' . $permission['id'] . '" data-toggle="tooltip" title="Remove Permission">
                        <i class="fas fa-trash-alt"></i> Remove
                    </button>'
            ];
        }

        // Return the data in JSON format for the DataTable
        return $this->response->setJSON(['data' => $data]);
    }


    // Save permissions for a role
    public function savePermissions($roleId)
    {
        $roles_permission_model = new RolePermissionModel();
        $permission_id = $this->request->getPost('permission_id');
        $roles_permission_model->savePermissions($roleId, $permission_id);
        return redirect()->to('roles/permissions/'.$roleId)->with('success', 'Permissions added successfully');
    }

    public function deletePermissions($roleId, $permissionId)
    {
        $role_model = new RoleModel();

        $role = $role_model->find($roleId);
        if (!$role) 
        {
            return redirect()->to('roles/permissions/'.$roleId)->with('error', 'Role not found.');
        }

        $roles_permission_model = new RolePermissionModel();

        $deleted = $roles_permission_model->where('role_id', $roleId)->where('permission_id', $permissionId)->delete();

        if($deleted)
        {
            return redirect()->to('roles/permissions/'.$roleId)->with('success','Permissions removed successfully');
        }
        else 
        {
            return redirect()->to('roles/permissions/'.$roleId)->with('error', '');
        }

    }
}
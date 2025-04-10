<?php

namespace App\Controllers;

use App\Models\PermissionModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionController extends BaseController
{
    public function index()
    {
        return view('pages/permissions/index');
    }

    public function getPermissionsData()
    {
        $permissionModel = new PermissionModel();
        $permissions = $permissionModel->getPermissions();

        // Prepare the response
        $data = [];
        foreach ($permissions as $permission) {
            $data[] = [
                'permission_name' => $permission['permission_name'],
                'description' => $permission['description'],
                'actions' => 
                    '<a href="' . base_url('permissions/edit/' . $permission['id']) . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a> 
                    <button class="btn btn-danger btn-sm delete-btn" data-permission-id="' . $permission['id'] . '" data-permission-name="' . $permission['permission_name'] . '">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }
}

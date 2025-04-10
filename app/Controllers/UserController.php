<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return view("pages/users/index");
    }

    public function getUsersData()
    {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        $data = [];

        foreach ($users as $user) {
            $roleBadges = '';
            if (!empty($user['role_names'])) {
                $roles = explode(',', $user['role_names']);
                foreach ($roles as $role) {
                    $roleBadges .= '<span class="badge badge-primary mr-1">' . esc($role) . '</span>';
                }
            } else {
                $roleBadges = '<span class="badge badge-secondary">N/A</span>';
            }

            // Toggle verify action based on the user's verified status
            $verifyAction = $user['verified'] 
                ? '<a href="#" class="dropdown-item verify-btn" data-user-id="' . $user['id'] . '" data-verify-status="unverify"><i class="fas fa-times-circle"></i> Unverify</a>'
                : '<a href="#" class="dropdown-item verify-btn" data-user-id="' . $user['id'] . '" data-verify-status="verify"><i class="fas fa-check-circle"></i> Verify</a>';

                $data[] = [
                    'full_name' => esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']),
                    'email'     => esc($user['email']),
                    'username'  => esc($user['username']),
                    'role'      => $roleBadges,
                    'office'    => esc($user['office_code']),
                    'status'    => esc($user['status_name']),
                    'verified'  => $user['verified']
                        ? '<span class="badge badge-success">Yes</span>'
                        : '<span class="badge badge-secondary">No</span>',
                    'actions'   => '<div class="btn-group text-center">'
                        . '<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="Actions">'
                        . '<i class="fas fa-cogs"></i> Actions</button>'
                        . '<div class="dropdown-menu">'
                        . '<a href="' . base_url('users/view/' . $user['id']) . '" class="dropdown-item"><i class="fas fa-eye"></i> View</a>'
                        . '<a href="' . base_url('users/edit/' . $user['id']) . '" class="dropdown-item"><i class="fas fa-edit"></i> Edit</a>'
                        . '<a href="#" class="dropdown-item reset-password-btn" data-user-id="' . $user['id'] . '" data-user-name="' . esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']) . '"><i class="fas fa-key"></i> Reset Password</a>'
                        . '<a href="#" class="dropdown-item reset-attempts-btn" data-user-id="' . $user['id'] . '" data-user-name="' . esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']) . '"><i class="fas fa-redo"></i> Reset Attempts</a>'
                        . ($user['verified'] ? '<a href="#" class="dropdown-item verify-btn" data-user-id="' . $user['id'] . '" data-user-name="' . esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']) . '" data-verify-status="unverify"><i class="fas fa-times-circle"></i> Unverify</a>' 
                                              : '<a href="#" class="dropdown-item verify-btn" data-user-id="' . $user['id'] . '" data-user-name="' . esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']) . '" data-verify-status="verify"><i class="fas fa-check-circle"></i> Verify</a>')
                        . '<a href="' . base_url('users/roles/' . $user['id']) . '" class="dropdown-item"><i class="fas fa-user-tag"></i> Manage Roles</a>'
                        . '<a href="#" class="dropdown-item text-danger delete-btn" data-toggle="tooltip" title="Delete user" data-user-id="' . $user['id'] . '" data-user-name="' . esc($user['lastname']) . ', ' . esc($user['firstname']) . ' ' . esc($user['middlename']) . '"><i class="fas fa-trash"></i> Delete</a>'
                        . '</div>'
                        . '</div>'
                ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function roles($userId)
    {
        // Load the necessary models
        $user_model = new UserModel();
        $role_model = new RoleModel();
        $userRole_model = new UserRoleModel();  // Assuming you have a UserRoleModel to manage the many-to-many relationship

        // Get the user by ID
        $user = $user_model->where('id', $userId)->first();

        if (!$user) {
            // Handle user not found, maybe redirect or show a 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        // Get all available roles
        $roles = $role_model->findAll();

        // Get the roles assigned to the user
        $assignedRoles = $userRole_model->select('role_id')->where('user_id', $userId)->findAll();
        $assignedRoleIds = array_column($assignedRoles, 'role_id');  // Extract the role_ids from the assigned roles

        // Filter out the assigned roles from the available roles
        $filteredRoles = array_filter($roles, function($role) use ($assignedRoleIds) {
            return !in_array($role['id'], $assignedRoleIds);
        });

        // Pass the user data, filtered roles, and assigned roles to the view
        return view('pages/users/user_roles', [
            'user' => $user,
            'roles' => $filteredRoles  // Pass the filtered roles to the view
        ]);
    }

    public function getRolesData($userId)
    {
        $userRolesModel = new UserRoleModel();
        $user_model = new UserModel();
        $user = $user_model->where('id', $userId)->first(); 
        $roles = $userRolesModel->where('user_id', $userId)
                                ->join('roles', 'roles.id = user_roles.role_id')
                                ->findAll();

        $data = [];

        foreach ($roles as $role) {
            $data[] = [
                'role' => esc($role['role_name']),
                'actions' => '<button class="btn btn-danger btn-sm delete-btn" 
                    data-role-id="' . $role['role_id'] . '" 
                    data-role-name="' . esc($role['role_name']) . '"
                    data-user-id="' . $user['id'] . '">
                    <i class="fa fa-minus"></i> Remove
                </button>'
            ];

        }
        // Return the data as JSON
        return $this->response->setJSON(['data' => $data]);
    }

    public function addRoleToUser($userId)
    {
        $roleId = $this->request->getPost('role');

        // Add role to user
        $userRoleModel = new UserRoleModel();
        $userRoleModel->save([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);

        // Flash success message
        session()->setFlashdata('success', 'Role added successfully.');
        
        return redirect()->to(base_url('users/roles/'.$userId));
    }
   
    public function deleteRole($userId, $roleId)
    {
        // Load the models
        $user_model = new UserModel();

        // Find the user by ID
        $user = $user_model->find($userId);
        if (!$user) {
            // If the user does not exist, redirect back with an error message
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        // Check if the user already has the role (in case there's a role association table)
        $userRoleModel = new UserRoleModel();

        // Delete the role for the user from the pivot table
        if ($userRoleModel->where('user_id', $userId)->where('role_id', $roleId)->delete()) {
            // Success, redirect back with a success message
            return redirect()->to('/users/roles/'.$userId)->with('success', 'Role successfully removed from the user.');
        } else {
            // If deletion failed, return an error message
            return redirect()->to('/users/roles/'.$userId)->with('error', 'Failed to delete role.');
        }
    }
}

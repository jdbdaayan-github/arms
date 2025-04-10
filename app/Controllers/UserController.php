<?php

namespace App\Controllers;

use App\Models\UserModel;
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
}

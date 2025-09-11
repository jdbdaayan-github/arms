<?php

use CodeIgniter\Database\BaseConnection;

if (! function_exists('hasRole')) {
    function hasRole(string $role): bool
    {
        $user = session()->get();

        if (!$user || empty($user['logged_in'])) {
            return false;
        }

        // Superadmin automatically has all roles
        if (isset($user['is_super']) && $user['is_super'] == 1) {
            return true;
        }

        /** @var BaseConnection $db */
        $db = \Config\Database::connect();

        $roleRow = $db->table('roles')
            ->select('role_name')
            ->where('role_name', $user['role'])
            ->get()
            ->getRow();

        if (!$roleRow) {
            return false;
        }

        return strtolower($roleRow->role_name) === strtolower($role);
    }
}

if (! function_exists('hasPermission')) {
    function hasPermission(string $permission): bool
    {
        $user = session()->get();
        if (!$user || empty($user['logged_in'])) {
            return false;
        }

        if (isset($user['is_super']) && $user['is_super'] == 1) {
            return true;
        }

        $permissions = session()->get('permissions');
        if ($permissions === null) {
            /** @var BaseConnection $db */
            $db = \Config\Database::connect();

            $builder = $db->table('permissions p')
                ->select('p.permission_name')
                ->join('role_permissions rp', 'rp.permission_id = p.id')
                ->join('roles r', 'r.id = rp.role_id')
                ->where('r.role_name', $user['role']);

            $permissions = array_column($builder->get()->getResultArray(), 'permission_name');
            session()->set('permissions', $permissions);
        }

        return in_array($permission, $permissions);
    }
}

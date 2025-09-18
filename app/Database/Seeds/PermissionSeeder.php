<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Records
            ['permission_name' => 'records.view', 'description' => 'View records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.create', 'description' => 'Create records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.edit', 'description' => 'Edit records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.delete', 'description' => 'Delete records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.retrieve', 'description' => 'Retreive deleted records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.archive', 'description' => 'Archive records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.approve', 'description' => 'Approve records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.purge', 'description' => 'Purge records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.download', 'description' => 'Download records', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'records.version.delete', 'description' => 'Delete record versions', 'created_at' => date('Y-m-d H:i:s')],

            // Roles
            ['permission_name' => 'roles.view', 'description' => 'View roles', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'roles.create', 'description' => 'Create roles', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'roles.edit', 'description' => 'Edit roles', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'roles.delete', 'description' => 'Delete roles', 'created_at' => date('Y-m-d H:i:s')],

            // Permissions
            ['permission_name' => 'permissions.view', 'description' => 'View permissions', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'permissions.create', 'description' => 'Create permissions', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'permissions.edit', 'description' => 'Edit permissions', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'permissions.delete', 'description' => 'Delete permissions', 'created_at' => date('Y-m-d H:i:s')],

            // Users
            ['permission_name' => 'users.view', 'description' => 'View users', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'users.create', 'description' => 'Create users', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'users.edit', 'description' => 'Edit users', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'users.delete', 'description' => 'Delete users', 'created_at' => date('Y-m-d H:i:s')],

            // Libraries
            ['permission_name' => 'libraries.view', 'description' => 'View libraries', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'libraries.create', 'description' => 'Create libraries', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'libraries.edit', 'description' => 'Edit libraries', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'libraries.delete', 'description' => 'Delete libraries', 'created_at' => date('Y-m-d H:i:s')],

            /*Offices
            ['permission_name' => 'offices.view', 'description' => 'View offices', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'offices.create', 'description' => 'Create offices', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'offices.delete', 'description' => 'Delete offices', 'created_at' => date('Y-m-d H:i:s')],

            Directorates
            ['permission_name' => 'directorates.view', 'description' => 'View directorates', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'directorates.create', 'description' => 'Create directorates', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'directorates.delete', 'description' => 'Delete directorates', 'created_at' => date('Y-m-d H:i:s')],*/

            // Activity Logs
            ['permission_name' => 'audit_logs.view', 'description' => 'View activity logs', 'created_at' => date('Y-m-d H:i:s')],
            ['permission_name' => 'access_logs.view', 'description' => 'View activity logs', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('permissions')->insertBatch($data);
    }
}

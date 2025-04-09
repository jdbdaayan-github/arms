<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'permission_name' => 'RecordsModule',
                'description' => 'Allow user to access Records Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_name' => 'RolesModule',
                'description' => 'Allow user to access Roles Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_name' => 'PermissionsModule',
                'description' => 'Allow user to access Permission Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_name' => 'UsersModule',
                'description' => 'Allow user to access Users Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_name' => 'UserStatusesModule',
                'description' => 'Allow user to access Users Statuses Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'permission_name' => 'ActivityLogsModule',
                'description' => 'Allow user to access Activity Logs Module',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        

        $this->db->table('permissions')->insertBatch($data);
    }
}

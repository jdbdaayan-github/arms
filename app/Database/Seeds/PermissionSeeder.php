<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'permission_name' => 'RecordsModule',
                'description' => 'Allow user to access Records Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 2,
                'permission_name' => 'RecordsCreateModule',
                'description' => 'Allow user to access Records Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 3,
                'permission_name' => 'RecordsEditModule',
                'description' => 'Allow user to access Records Edit Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 4,
                'permission_name' => 'RecordsDeleteModule',
                'description' => 'Allow user to access Records Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 5,
                'permission_name'=> 'RecordVersionDeleteModule',
                'description' => 'Allows user to access Record Version Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 6,
                'permission_name' => 'RolesModule',
                'description' => 'Allow user to access Roles Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 7,
                'permission_name' => 'RolesCreateModule',
                'description' => 'Allow user to access Roles Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 8,
                'permission_name' => 'RolesEditModule',
                'description' => 'Allow user to access Roles Edit Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 9,
                'permission_name' => 'RolesDeleteModule',
                'description' => 'Allow user to access Roles Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 10,
                'permission_name' => 'PermissionsModule',
                'description' => 'Allow user to access Permission Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 11,
                'permission_name' => 'PermissionsCreateModule',
                'description' => 'Allow user to access Permission Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 12,
                'permission_name' => 'PermissionsEditModule',
                'description' => 'Allow user to access Permission Edit Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 13,
                'permission_name' => 'PermissionsDeleteModule',
                'description' => 'Allow user to access Permission Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 14,
                'permission_name' => 'UsersModule',
                'description' => 'Allow user to access Users Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 15,
                'permission_name' => 'UsersCreateModule',
                'description' => 'Allow user to access Users Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 16,
                'permission_name' => 'UsersDeleteModule',
                'description' => 'Allow user to access Users Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 17,
                'permission_name' => 'LibrariesModule',
                'description' => 'Allow user to access Libraries Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 18,
                'permission_name' => 'LibrariesCreateModule',
                'description' => 'Allow user to access Libraries Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 19,
                'permission_name' => 'LibrariesModifyModule',
                'description'=> 'Allows user to access Libararies Modify Module',
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 20,
                'permission_name' => 'LibrariesDeleteModule',
                'description' => 'Allow user to access Libraries Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 21,
                'permission_name' => 'ActivityLogsModule',
                'description' => 'Allow user to access Activity Logs Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 22,
                'permission_name' => 'OfficesModule',
                'description' => 'Allow user to access Offices Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 23,
                'permission_name' => 'OfficesCreateModule',
                'description' => 'Allow user to access Offices Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 24,
                'permission_name' => 'OfficesDeleteModule',
                'description' => 'Allow user to access Offices Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 25,
                'permission_name' => 'DirectoratesModule',
                'description' => 'Allow user to access Directorates Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 26,
                'permission_name' => 'DirectoratesCreateModule',
                'description' => 'Allow user to access Directorates Create Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 27,
                'permission_name' => 'DirectoratesDeleteModule',
                'description' => 'Allow user to access Directorates Delete Module',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('permissions')->insertBatch($data);
    }
}

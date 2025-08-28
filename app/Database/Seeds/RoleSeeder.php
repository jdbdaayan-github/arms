<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'role_name'   => 'Super Admin',  
                'description' => 'Full access to all parts of the system. Can manage users, roles, and permissions.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'role_name'   => 'Administrator',  
                'description' => 'Manages system settings, user accounts, and general administrative tasks.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'role_name'   => 'Archivist',  
                'description' => 'Responsible for organizing and preserving historical and current records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'role_name'   => 'Record Contributor',  
                'description' => 'Can create and upload records but has limited access to administrative features.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'role_name'   => 'Auditor',  
                'description' => 'Reviews and audits records and user activity. Can view logs but cannot modify records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'role_name'   => 'Viewer',  
                'description' => 'Read-only access to records. Can view/search but cannot edit or delete.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}

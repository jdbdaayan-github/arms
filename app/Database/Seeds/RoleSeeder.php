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
                'role_name'   => 'superadmin',  
                'description' => 'Has full access to all parts of the system. Can manage users, roles, and permissions.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 2,
                'role_name'   => 'admin',  
                'description' => 'Manages system settings, user accounts, and general administrative tasks.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 3,
                'role_name'   => 'records_manager',  
                'description' => 'Oversees the management of records within the system. Responsible for maintaining accurate records and ensuring compliance with policies.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 4,
                'role_name'   => 'archivist',  
                'description' => 'Responsible for the preservation and organization of historical records and documents.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 5,
                'role_name'   => 'records_contributor_uploader',  
                'description' => 'Can upload and contribute records to the system, but has limited access to other features.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 6,
                'role_name'   => 'compliance_officer',  
                'description' => 'Ensures that the records management system complies with all applicable regulations and standards.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 7,
                'role_name'   => 'disposal_officer',  
                'description' => 'Manages the disposal of records according to the retention schedules and legal requirements.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 8,
                'role_name'   => 'records_officer',  
                'description' => 'Responsible for the general management of records in the system. Handles storage, retrieval, and disposition of records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 9,
                'role_name'   => 'researcher',  
                'description' => 'Can access records for research purposes, but has limited access to modify or manage records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 10,
                'role_name'   => 'public_user',  
                'description' => 'Has view-only access to public records, suitable for external users or visitors.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 11,
                'role_name'   => 'unsigned',  
                'description' => 'Default role for newly registered user',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}

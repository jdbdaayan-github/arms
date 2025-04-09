<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name'   => 'superadmin',  // Changed to snake_case
                'description' => 'Has full access to all parts of the system. Can manage users, roles, and permissions.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'admin',  // Changed to snake_case
                'description' => 'Manages system settings, user accounts, and general administrative tasks.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'records_manager',  // Changed to snake_case
                'description' => 'Oversees the management of records within the system. Responsible for maintaining accurate records and ensuring compliance with policies.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'archivist',  // Changed to snake_case
                'description' => 'Responsible for the preservation and organization of historical records and documents.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'records_contributor_uploader',  // Changed to snake_case
                'description' => 'Can upload and contribute records to the system, but has limited access to other features.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'compliance_officer',  // Changed to snake_case
                'description' => 'Ensures that the records management system complies with all applicable regulations and standards.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'disposal_officer',  // Changed to snake_case
                'description' => 'Manages the disposal of records according to the retention schedules and legal requirements.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'records_officer',  // Changed to snake_case
                'description' => 'Responsible for the general management of records in the system. Handles storage, retrieval, and disposition of records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'researcher',  // Changed to snake_case
                'description' => 'Can access records for research purposes, but has limited access to modify or manage records.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'role_name'   => 'public_user',  // Changed to snake_case
                'description' => 'Has view-only access to public records, suitable for external users or visitors.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert the data into the 'roles' table
        $this->db->table('roles')->insertBatch($data);
    }
}

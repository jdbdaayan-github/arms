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
                'role_name'   => 'Superadmin',
                'description' => 'Has full control of the system. Manages users, roles, permissions, and system security.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'role_name'   => 'Administrator',
                'description' => 'Handles overall system administration. Manages settings, monitors usage, and ensures compliance.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'role_name'   => 'Archivist',
                'description' => 'Custodian of permanent records. Organizes, preserves, and controls access to archival materials.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'role_name'   => 'Records Officer',
                'description' => 'Validates and forwards records for archiving. Ensures metadata and record completeness before transfer.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'role_name'   => 'Contributor',
                'description' => 'Can create and submit records for archiving but cannot edit or delete once submitted.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'role_name'   => 'Viewer',
                'description' => 'Read-only access. Can search and view archived records but cannot modify or delete.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];


        $this->db->table('roles')->insertBatch($data);
    }
}

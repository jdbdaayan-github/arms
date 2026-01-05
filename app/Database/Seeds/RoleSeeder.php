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
                'description' => 'Manages archives, approves submissions, and monitors the system usage. Cannot change system settings or Superadmin accounts.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'role_name'   => 'Standard User',
                'description' => 'Can upload records for archiving and view their submissions. Cannot edit or delete after upload.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];


        $this->db->table('roles')->insertBatch($data);
    }
}

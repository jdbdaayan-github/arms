<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserTesterSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'firstname' => 'Office',
                'middlename' => 'A.',
                'lastname' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@email.com',
                'password' => password_hash('admin1234', PASSWORD_DEFAULT),
                'status_id' => 2, // Active
                'role_id' => 2,   // Admin
                'verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'firstname' => 'Standard',
                'middlename' => 'U.',
                'lastname' => 'User',
                'username' => 'user',
                'email' => 'user@email.com',
                'password' => password_hash('user1234', PASSWORD_DEFAULT),
                'status_id' => 2, // Active
                'role_id' => 3,   // Standard User
                'verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);
    }
}

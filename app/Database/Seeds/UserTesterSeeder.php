<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserTesterSeeder extends Seeder
{
    public function run()
    {
        $superusers = [
            [
                'firstname' => 'Admin',
                'middlename'=> 'A.',
                'lastname'=> 'Admin',
                'username' => 'admin',
                'email' => 'admin@email.com',
                'password' => password_hash('admin1234', PASSWORD_DEFAULT),
                'status_id' => 2,
                'role_id' => 2,
                'verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
        ],
        [
                'firstname' => 'Contri',
                'middlename'=> 'C.',
                'lastname'=> 'Contributor',
                'username' => 'contributor',
                'email' => 'contributor@email.com',
                'password' => password_hash('contributor1234', PASSWORD_DEFAULT),
                'status_id' => 2,
                'role_id' => 5,
                'verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
        ],
            
        ];
        $this->db->table('users')->insertBatch($superusers);
    }
}

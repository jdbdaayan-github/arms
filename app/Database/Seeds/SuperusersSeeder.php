<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperusersSeeder extends Seeder
{
    public function run()
    {
        $superusers = [
            [
                'firstname' => 'superadmin',
                'username' => 'superadmin',
                'email' => 'jdbdaayan@dswd.gov.ph',
                'password' => password_hash('records1234', PASSWORD_DEFAULT),
                'office_id' => 2,
                'status_id' => 2,
                'verified' => 1,
        ],
            
        ];
        $this->db->table('users')->insertBatch($superusers);

        $roles = [
            [
                'user_id'=> 1,
                'role_id'=> 1,
            ],
        ];
        $this->db->table('user_roles')->insertBatch($roles);
    }
}

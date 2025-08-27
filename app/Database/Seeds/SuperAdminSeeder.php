<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $superusers = [
            [
                'firstname' => 'June Delrey',
                'middlename'=> 'B.',
                'lastname'=> 'Da-ayan',
                'username' => 'jdbdaayan',
                'email' => 'jdbdaayan@dswd.gov.ph',
                'password' => password_hash('daayan1996', PASSWORD_DEFAULT),
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

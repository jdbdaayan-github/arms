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
                'role_id' => 1,
                'verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
        ],
            
        ];
        $this->db->table('users')->insertBatch($superusers);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DirectoratesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'AS',
                'name'     => 'Administrative Service',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];
        
        // Insert data into the directorates table
        $this->db->table('directorates')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'              => 1,
                'name'            => 'Pending',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'              => 2,
                'name'            => 'Active',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'              => 3,
                'name'            => 'Inactive',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'              => 4,
                'name'            => 'Banned',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'              => 5,
                'name'            => 'Locked',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [   
                'id'              => 6, 
                'name'            => 'Archived',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('user_statuses')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserStatusesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Pending'],
            ['id' => 2, 'name' => 'Active'],
            ['id' => 3, 'name' => 'Inactive'],
            ['id' => 4, 'name' => 'Banned'],
            ['id' => 5, 'name' => 'Archived'],
        ];
        $this->db->table('user_statuses')->insertBatch($data);
    }
}

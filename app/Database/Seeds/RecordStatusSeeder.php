<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordStatusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'name' => 'Pending Approval', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Approved',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Rejected',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Archived',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Superseded',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Disposed',         'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('record_statuses')->insertBatch($data);
    }
}

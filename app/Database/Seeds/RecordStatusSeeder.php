<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordStatusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'name' => 'Pending', 'description' => 'Record uploaded, waiting for approval', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Archived', 'description' => 'Record approved and stored in the archive', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Deleted', 'description' => 'Record has been deleted', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('record_statuses')->insertBatch($data);
    }
}

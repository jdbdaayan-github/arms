<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordStatusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'name' => 'Uploaded',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Pending Review',     'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'For Classification', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Active',             'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Archived',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Superseded',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Withdrawn',          'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Deleted',            'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'For Disposal',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'Disposed',          'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('record_statuses')->insertBatch($data);
    }
}

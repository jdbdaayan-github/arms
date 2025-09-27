<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordStatusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'name' => 'Draft', 'description' => 'Being created, not yet submitted', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'For Approval', 'description' => 'Submitted for approval by Records Officer', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Approved', 'description' => 'Validated and considered an official record and ready for archived', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'For Archival', 'description' => 'Record is scheduled to be archived', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Archived', 'description' => 'Record is stored in the archive', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Restored', 'description' => 'Record has been restored from the archive', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Borrowed', 'description' => 'Record is currently borrowed', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Deleted', 'description' => 'Record is deleted', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('record_statuses')->insertBatch($data);
    }
}

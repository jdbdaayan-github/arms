<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordCategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "id"=> 1,
                'code' => 'A',
                'name'     => 'ADMINISTRATIVE RECORDS',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 2,
                'code' => 'F',
                'name'     => 'FINANCIAL RECORDS',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 3,
                'code' => 'L',
                'name'     => 'LEGAL RECORDS',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 4,
                'code' => 'P',
                'name'     => 'PERSONNEL RECORDS',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 5,
                'code' => 'SS',
                'name'     => 'SOCIAL SERVICES RECORDS',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('record_categories')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordTypesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'AO',
                'name'     => 'ADMINISTRATIVE ORDER',
                'category_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'MA',
                'name'     => 'MEMORANDUM ADVISORY',
                'category_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'MC',
                'name'     => 'MEMORANDUM CIRCULAR',
                'category_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'SO',
                'name'     => 'SPECIAL ORDER',
                'category_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'C',
                'name'     => 'CERTIFCATE',
                'category_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('record_types')->insertBatch($data);
    }
}

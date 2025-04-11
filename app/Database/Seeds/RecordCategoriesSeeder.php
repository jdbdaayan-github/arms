<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordCategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'AO',
                'name'     => 'Administrative Order',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'MA',
                'name'     => 'Memorandum Advisory',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'MC',
                'name'     => 'Memorandum Circular',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'SO',
                'name'     => 'Special Order',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'CERT',
                'name'     => 'Certificate',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('record_categories')->insertBatch($data);
    }
}

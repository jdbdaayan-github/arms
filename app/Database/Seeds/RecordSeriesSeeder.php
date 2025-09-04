<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordSeriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "id"=> 1,
                'code' => 'AO',
                'name'     => 'Administrative Order',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 2,
                'code' => 'MA',
                'name'     => 'Memorandum Advisory',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 3,
                'code' => 'MC',
                'name'     => 'Memorandum Circular',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 4,
                'code' => 'SO',
                'name'     => 'Special Order',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 5,
                'code' => 'Cert',
                'name'     => 'Certificate',
                'classification_id'=> 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 6,
                'code'=> 'DO',
                'name'=> 'Department Order',
                'classification_id' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 7,
                'code'=> 'DC',
                'name' => 'Department Circular',
                'classification_id' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 8,
                'code'=> 'TO',
                'name' => 'Travel Order',
                'classification_id' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'code' => 'FO',
                'classification_id' => 1,
                'name' => 'Field Office',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('record_series')->insertBatch($data);
    }
}

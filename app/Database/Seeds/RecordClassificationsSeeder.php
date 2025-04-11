<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordClassificationsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "id"=> 1,
                'code' => 'A',
                'name'     => 'Administrative Records',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 2,
                'code' => 'F',
                'name'     => 'FIinancial Records',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 3,
                'code' => 'L',
                'name'     => 'Legal Records',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 4,
                'code' => 'P',
                'name'     => 'Personnel Records',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'id'=> 5,
                'code' => 'SS',
                'name'     => 'Social Services Records',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('record_classifications')->insertBatch($data);
    }
}

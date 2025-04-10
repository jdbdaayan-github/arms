<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordIndexesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "id"=> 1,
                "name" => "ORDINANCE NO.",
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 2,
                "name" => "SERIES",
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 3,
                "name" => "SUBJECT",
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

    }
}

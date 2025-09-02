<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordIndexSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "id"=> 1,
                "name" => "Admin Issuance",
                "type" => "text",
                "length" => 10,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 2,
                "name" => "Ordinance No.",
                "type" => "number",
                "length" => 10,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 3,
                "name" => "Series No.",
                "type" => "number",
                "length" => 10,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 4,
                "name" => "Subject",
                "type" => "text",
                "length" => 50,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 5,
                "name" => "Type of Certificate",
                "type" => "text",
                "length" => 50,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                "id"=> 6,
                "name" => "Name of Agency",
                "type" => "text",
                "length" => 50,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('record_indexes')->insertBatch($data);
    }
}

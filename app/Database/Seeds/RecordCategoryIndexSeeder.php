<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordCategoryIndexSeeder extends Seeder
{
    public function run()
    {
         $data = [
            [
                "record_category_id" => 1,
                "record_index_id" => 1,
            ],
            [
                "record_category_id" => 1,
                "record_index_id" => 2,
            ],
            [
                "record_category_id" => 1,
                "record_index_id" => 3,
            ],
            [
                "record_category_id" => 1,
                "record_index_id" => 4,
            ],
            [
                "record_category_id" => 3,
                "record_index_id" => 1,
            ],
            [
                "record_category_id" => 3,
                "record_index_id" => 2,
            ],
            [
                "record_category_id" => 3,
                "record_index_id" => 3,
            ],
            [
                "record_category_id" => 3,
                "record_index_id" => 4,
            ],
            [
                "record_category_id" => 4,
                "record_index_id" => 1,
            ],
            [
                "record_category_id" => 4,
                "record_index_id" => 2,
            ],
            [
                "record_category_id" => 4,
                "record_index_id" => 3,
            ],
            [
                "record_category_id" => 4,
                "record_index_id" => 4,
            ],
            [
                "record_category_id" => 5,
                "record_index_id" => 5,
            ],
            [
                "record_category_id" => 5,
                "record_index_id" => 6,
            ],
        ];

        $this->db->table("record_category_indexes")->insertBatch($data);
    }
}

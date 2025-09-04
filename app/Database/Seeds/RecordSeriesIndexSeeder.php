<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordSeriesIndexSeeder extends Seeder
{
    public function run()
    {
         $data = [
            [
                "record_series_id" => 1,
                "record_index_id" => 1,
            ],
            [
                "record_series_id" => 1,
                "record_index_id" => 2,
            ],
            [
                "record_series_id" => 1,
                "record_index_id" => 3,
            ],
            [
                "record_series_id" => 1,
                "record_index_id" => 4,
            ],
            [
                "record_series_id" => 3,
                "record_index_id" => 1,
            ],
            [
                "record_series_id" => 3,
                "record_index_id" => 2,
            ],
            [
                "record_series_id" => 3,
                "record_index_id" => 3,
            ],
            [
                "record_series_id" => 3,
                "record_index_id" => 4,
            ],
            [
                "record_series_id" => 4,
                "record_index_id" => 1,
            ],
            [
                "record_series_id" => 4,
                "record_index_id" => 2,
            ],
            [
                "record_series_id" => 4,
                "record_index_id" => 3,
            ],
            [
                "record_series_id" => 4,
                "record_index_id" => 4,
            ],
            [
                "record_series_id" => 5,
                "record_index_id" => 5,
            ],
            [
                "record_series_id" => 5,
                "record_index_id" => 6,
            ],
        ];

        $this->db->table("record_series_indexes")->insertBatch($data);
    }
}

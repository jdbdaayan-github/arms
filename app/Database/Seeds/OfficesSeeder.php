<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OfficesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code'            => 'AS',
                'name'            => 'Administrative Service',
                'directorate_id'  => 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'code'            => 'AS-RAMD',
                'name'            => 'Administrative Service-Records and Archives Management Division',
                'directorate_id'  => 1,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('offices')->insertBatch($data);
    }
}

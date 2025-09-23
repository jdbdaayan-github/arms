<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordRequestTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Certified True Copy', 'description' => 'Official certified copy of a record'],
            ['name' => 'Photocopy Request', 'description' => 'Plain copy of a record (not certified)'],
            ['name' => 'Digital Copy Request', 'description' => 'Request for scanned/digital copy'],
            ['name' => 'Borrowing of Original Document', 'description' => 'Temporary borrowing of original'],
            ['name' => 'Record Verification', 'description' => 'Verification of authenticity or details'],
            ['name' => 'Document Retrieval', 'description' => 'Request to retrieve file from archive'],
            ['name' => 'Certification of Record Availability', 'description' => 'Certificate that a record exists/does not exist'],
            ['name' => 'Confidential Document Access', 'description' => 'Restricted request with approval'],
            ['name' => 'Inventory/Listing Request', 'description' => 'Request for list/index of records'],
            ['name' => 'Disposition Request', 'description' => 'For disposal/transfer of records'],
        ];

        $this->db->table('record_request_types')->insertBatch($data);
    }
}

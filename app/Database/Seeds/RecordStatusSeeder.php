<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordStatusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id'=>1,'name'=>'Draft','description'=>'Being created, not yet submitted','created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'name'=>'For Approval','description'=>'Submitted for approval by Records Officer','created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'name'=>'Approved','description'=>'Approved and ready for digitization','created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'name'=>'Digitized','description'=>'Record has been digitized/uploaded','created_at'=>$now,'updated_at'=>$now],
            ['id'=>5,'name'=>'Archived','description'=>'Record is stored in archive','created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,'name'=>'Borrowed','description'=>'Record is currently borrowed','created_at'=>$now,'updated_at'=>$now],
            ['id'=>7,'name'=>'Superseded','description'=>'Record replaced by a newer version','created_at'=>$now,'updated_at'=>$now],
        ];

        $this->db->table('record_statuses')->insertBatch($data);
    }
}

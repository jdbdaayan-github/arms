<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "key"=> "system_logotext",
                "value"=> "ARMS",
            ],
            [
                "key"=> "system_name",
                "value"=> "Archival Records Management System",
            ],
            [
                "key"=> "system_owner",
                "value"=> "AS-Records and Archives Management Division",
            ],
            [
                "key"=> "system_timezone",
                "value"=> "Asia/Manila",
            ],
            [
                "key"=> "system_version",
                "value"=> "1.0",
            ],
            [
                "key"=> "sessiontime",
                "value"=> "20",
            ],
            [
                "key"=> "autologout",
                "value"=> "true",
            ],
            [
                "key"=> "maxfilesize",
                "value"=> "10",
            ],
            [
                "key" =>"allowedfiletype",
                "value"=> "pdf",
            ],
            [
                "key"=> "defaultconifidentiality",
                "value"=> "0",
            ],

        ];
        
        $this->db->table("settings")->insertBatch($data);
    }
}

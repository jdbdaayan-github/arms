<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordFileVersionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> ["type"=> "INT","constraint"=> 11,"auto_increment"=> true,],
            "record_id"=> ["type"=> "INT","constraint"=> 11,"unsigned"=>TRUE,],
            "user_id"=> ["type"=> "INT","constraint"=> 11,"unsigned"=>TRUE,],
            "filename" => ["type"=> "VARCHAR", "constraint" => 255,],
            "randomfilename" => ["type"=> "VARCHAR","constraint"=> 255],
            "version" => ["type"=> "VARCHAR", "constraint" => 10, "default"=> "1.0"],
            "note" => ["type" => "TEXT", "constraint" => 100,"null"=> true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');
            $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
            $this->forge->createTable('record_file_versions');
    }

    public function down()
    {
        $this->forge->dropTable('record_file_versions');
    }
}

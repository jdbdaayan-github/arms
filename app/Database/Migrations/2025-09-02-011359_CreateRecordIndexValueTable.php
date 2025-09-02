<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordIndexValueTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> [
                "type"=> "INT",
                "constraint"=> 11,
                "unsigned"=> true,
                "auto_increment"=> true,
            ],
            "record_id"=> [
                "type"=> "INT",
                "unsigned" => true,
            ],
            "index_id"=> [
                "type"=> "INT",
                "unsigned"=> true,
            ],
            "value"=> [
                "type"=> "TEXT",
            ],
            "created_at"=> [
                "type"=> "DATETIME",
                "null" => true,
            ],
            "updated_at"=> [
                "type" => "DATETIME",
                "null"=> true,
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("record_id","records","id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("index_id","record_indexes","id", "CASCADE", "CASCADE");
        $this->forge->createTable("record_index_values");
    }

    public function down()
    {
        $this->forge->dropTable("record_index_values");
    }
}

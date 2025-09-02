<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivityTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> [
                "type" => "INT",
                "auto_increment"=> true,
                "unsigned" => true,
            ],
            "user_id" => [
                "type" => "INT",
                "unsigned" => true,
                "null" => true,
            ],
            "activity" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "module" => [
                "type"=> "VARCHAR",
                "constraint" => 100,
                "null" => true,
            ],
            "record_id" => [
                "type" => "INT",
                "null" => true,
            ],
            "action"=> [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "ip_address" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "user_agent" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "created_at" => [
                "type"=> "DATETIME",
            ],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("user_id","users", "id","CASCADE","CASCADE");
        $this->forge->createTable("activities");
    }

    public function down()
    {
        $this->forge->dropTable("activities");
    }
}

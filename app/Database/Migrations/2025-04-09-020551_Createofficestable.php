<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createofficestable extends Migration
{
    public function up()
    {
        // Create the 'offices' table with timestamps
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'name'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'directorate_id'  => ['type' => 'INT', 'unsigned' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('directorate_id', 'directorates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('offices');
    }

    public function down()
    {
        // Drop the 'offices' table
        $this->forge->dropTable('offices');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createuserstatusestable extends Migration
{
    public function up()
    {
        // Create the 'statuses' table with timestamps
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user_statuses');
    }

    public function down()
    {
        // Drop the 'statuses' table
        $this->forge->dropTable('user_statuses');
    }
}

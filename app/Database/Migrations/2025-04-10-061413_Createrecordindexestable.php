<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrecordindexestable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('record_indexes');
    }

    public function down()
    {
        $this->forge->dropTable('record_indexes');
    }
}

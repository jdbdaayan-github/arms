<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordIndexTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 50],
            'type'          => ['type'=> 'VARCHAR', 'constraint' => 50],
            'length'        => ['type' => 'INT', 'constraint' => 100],
            'placeholder'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'required'      => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('record_indexes');
    }

    public function down()
    {
        $this->forge->dropTable('record_indexes');
    }
}

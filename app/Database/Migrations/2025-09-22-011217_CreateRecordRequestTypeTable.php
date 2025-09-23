<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordRequestTypeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 50],
            'description' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME','null' => true],
            'updated_at' => ['type' => 'DATETIME','null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('record_request_types');
    }

    public function down()
    {
        $this->forge->dropTable('record_request_types');
    }
}

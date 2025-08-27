<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordClassificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('record_classifications');
    }

    public function down()
    {
        $this->forge->dropTable('record_classifications');
    }
}

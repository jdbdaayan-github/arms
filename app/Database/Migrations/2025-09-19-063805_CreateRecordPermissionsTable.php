<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordPermissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraints' => 20],
            'description' => ['type' => 'VARCHAR' ,'constraint' => 100],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME' , 'null' => true]
        ]);

        $this->forge->createTable('record_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('record_permissions');
    }
}

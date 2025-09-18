<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkflowTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_autoincrement' => true],
            'record_id' => ['type' => 'INT', 'unsigned' => true, 'constraint' => 11],
            'user_id' => ['type' => 'INT', 'unsigned' => true, 'constraint' => 11],
            'record_status_id' => ['type' => 'INT', 'unsigned' => true, 'constraint' => 11],
            'remarks' => ['type' => 'VARCHAR', 'constraint' => 100],
            'action_date' => ['type' => 'DATETIME'],
            'step' => ['type' => 'INT', 'constraint' => 10]
        ]);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_status_id', 'record_statuses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('record_workflows');
    }

    public function down()
    {
        $this->forge->dropTable('record_workflows');
    }
}

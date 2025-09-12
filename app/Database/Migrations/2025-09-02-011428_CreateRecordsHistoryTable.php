<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordsHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'record_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'user_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'action' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],

        ]);

        $this->forge->addKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('record_history');
    }

    public function down()
    {
        $this->forge->dropTable('record_history');
    }
}

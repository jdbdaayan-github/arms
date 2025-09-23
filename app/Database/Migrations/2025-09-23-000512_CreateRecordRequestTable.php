<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordRequestTable extends Migration
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
            ],
            'user_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'borrowed_at' => [           // When actually borrowed
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'expected_return_at' => [    // Optional due date
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'returned_at' => [           // When returned
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'remarks' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'request_id' => ['type' => 'INT', 'unsigned' => true],
            'status' => [
                'type'       => "ENUM('Pending','Borrowed','Returned','Done')",
                'default'    => 'Pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('request_id', 'record_request_types', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('record_requests', true);
    }

    public function down()
    {
        $this->forge->dropTable('record_requests');
    }
}

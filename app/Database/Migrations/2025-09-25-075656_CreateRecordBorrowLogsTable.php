<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordBorrowLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'record_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'borrowed_at' => ['type' => 'DATETIME', 'null' => true],
            'returned_at' => ['type' => 'DATETIME', 'null' => true],
            'status' => ['type' => "ENUM('Borrowed','Returned','Overdue')", 'default' => 'Borrowed'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('record_id' ,'records', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id' ,'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('record_borrow_logs');
    }

    public function down()
    {
        $this->forge->dropTable('record_borrow_logs');
    }
}

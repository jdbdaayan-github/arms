<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserRecordPermissionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT' , 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'record_permission_id' => ['type' => 'INT', 'unsigned' => true],
            'record_id' => ['type' => 'INT', 'unsigned' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_permission_id', 'record_permissions' ,'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('user_record_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('user_record_permissions');
    }
}

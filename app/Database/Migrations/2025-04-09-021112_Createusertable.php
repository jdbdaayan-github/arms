<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createusertable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'firstname'   => ['type' => 'VARCHAR', 'constraint' => '100'],
            'middlename'  => ['type' => 'VARCHAR', 'constraint' => '100'],
            'lastname'    => ['type' => 'VARCHAR', 'constraint' => '100'],
            'extension'   => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'office_id'   => ['type' => 'INT', 'unsigned' => true],
            'username'    => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'password'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'status_id'   => ['type' => 'INT', 'unsigned' => true],
            'verified'    => ['type' => 'BOOLEAN', 'default' => FALSE],
            'login_attempts' => ['type' => 'INT', 'default' => 0],
            'created_at'  => ['type' => 'DATETIME'],
            'updated_at'  => ['type' => 'DATETIME'],
            'deleted_at'  => ['type' => 'DATETIME'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('office_id', 'offices', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'user_statuses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

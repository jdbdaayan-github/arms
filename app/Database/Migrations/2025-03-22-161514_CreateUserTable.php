<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'firstName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'middleName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'LastName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'extensionName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'directorate_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'office_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'locked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_by' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'defaultCurrent' => true,
            ],
            'updated_by' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,

            ],
            'deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,

            ],

        ]);
        $this->forge->addPrimaryKey('userID');
        $this->forge->addForeignKey('directorate_id', 'directorates', 'directorateID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('office_id', 'offices', 'officeID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'userID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users', 'userID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('deleted_by', 'users', 'userID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

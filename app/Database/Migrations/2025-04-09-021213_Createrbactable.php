<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrbactable extends Migration
{
    public function up()
    {
        // Roles Table
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'role_name'     => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'description'   => ['type' => 'TEXT', 'null' => true],  // Added description for clarity
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('roles');

        // Permissions Table
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'permission_name'  => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'description'      => ['type' => 'TEXT', 'null' => true],  // Added description for clarity
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('permissions');

        // User Roles Table (Many-to-Many)
        $this->forge->addField([
            'user_id'  => ['type' => 'INT', 'unsigned' => true],
            'role_id'  => ['type' => 'INT', 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey(['user_id', 'role_id']);  // Composite Primary Key
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_roles');

        // Role Permissions Table (Many-to-Many)
        $this->forge->addField([
            'role_id'       => ['type' => 'INT', 'unsigned' => true],
            'permission_id' => ['type' => 'INT', 'unsigned' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey(['role_id', 'permission_id']);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'permissions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('role_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('role_permissions');
        $this->forge->dropTable('user_roles');
        $this->forge->dropTable('permissions');
        $this->forge->dropTable('roles');
    }
}

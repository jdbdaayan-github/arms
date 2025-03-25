<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => ['type' => 'INT','constraints'=>11, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}

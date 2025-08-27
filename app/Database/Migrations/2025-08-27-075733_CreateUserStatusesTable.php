<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserStatusesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'      => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'created_at'  => ['type' => 'DATETIME'],
            'updated_at'  => ['type' => 'DATETIME'],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user_statuses');
    }

    public function down()
    {
        $this->forge->dropTable('user_statuses');
    }
}

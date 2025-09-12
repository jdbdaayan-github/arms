<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivityTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
           'id'          => ['type' => 'BIGINT', 'auto_increment' => true],
            'timestamp'   => ['type' => 'DATETIME'],
            'user_id'     => ['type' => 'INT', 'null' => true],
            'username'    => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'action'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'module'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'record_id'   => ['type' => 'INT', 'null' => true],
            'old_data'    => ['type' => 'JSON', 'null' => true],
            'new_data'    => ['type' => 'JSON', 'null' => true],
            'description' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'ip_address'  => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'user_agent'  => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("activities");
    }

    public function down()
    {
        $this->forge->dropTable("activities");
    }
}

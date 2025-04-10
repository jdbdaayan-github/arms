<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrecordtypestable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'category_id'   => ['type' => 'INT', 'unsigned' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('category_id','record_categories','id','CASCADE','CASCADE');
        $this->forge->createTable('record_types');
    }

    public function down()
    {
        $this->forge->dropTable('record_types');
    }
}

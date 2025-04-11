<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrecordcategoriestable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'classification_id'   => ['type' => 'INT', 'unsigned' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('classification_id','record_classifications','id','CASCADE','CASCADE');
        $this->forge->createTable('record_categories');
    }

    public function down()
    {
        $this->forge->dropTable('record_categories');
    }
}

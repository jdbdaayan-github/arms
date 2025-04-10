<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrecordstypeindexestable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'record_type_id'  => ['type' => 'INT', 'unsigned' => true],
            'record_index_id'  => ['type' => 'INT', 'unsigned' => true],
        ]);
        // Composite primary key
        $this->forge->addKey(['record_type_id', 'record_index_id'], true);
        
        $this->forge->addForeignKey('record_type_id', 'record_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_index_id', 'record_indexes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('record_type_indexes');
    }

    public function down()
    {
        $this->forge->dropTable('record_type_indexes');
    }
}

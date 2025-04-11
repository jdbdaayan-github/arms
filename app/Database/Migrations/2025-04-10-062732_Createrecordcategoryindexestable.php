<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createrecordcategoryindexestable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'record_category_id'  => ['type' => 'INT', 'unsigned' => true],
            'record_index_id'  => ['type' => 'INT', 'unsigned' => true],
        ]);
        // Composite primary key
        $this->forge->addKey(['record_type_id', 'record_index_id'], true);
        
        $this->forge->addForeignKey('record_category_id', 'record_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_index_id', 'record_indexes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('record_category_indexes');
    }

    public function down()
    {
        $this->forge->dropTable('record_category_indexes');
    }
}

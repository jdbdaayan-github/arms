<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeriesIndexTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'record_series_id'  => ['type' => 'INT', 'unsigned' => true],
            'record_index_id'  => ['type' => 'INT', 'unsigned' => true],
        ]);
        
        $this->forge->addKey(['record_series_id', 'record_index_id'], true);
        $this->forge->addForeignKey('record_series_id', 'record_series', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_index_id', 'record_indexes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('record_series_indexes');
    }

    public function down()
    {
        $this->forge->dropTable('record_series_indexes');
    }
}

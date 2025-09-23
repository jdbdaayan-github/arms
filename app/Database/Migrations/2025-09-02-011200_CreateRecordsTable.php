<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> [
                'type'=> 'INT',
                'constraint'=> 11,
                'unsigned' => true,
                'auto_increment'=> true,
            ],
            'title'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
            ],
            'series_id'=> [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'confidential' => [
                'type'=> 'VARCHAR',
                'constraint' => 11,
            ],
            'record_date' => [
                'type'=> 'DATETIME',
                'null'=> true,
            ],
            'status_id'=> [
                'type'=> 'INT',
                'unsigned'=> TRUE,
                'default' => 1,
            ],
            'created_by'=> [
                'type'=> 'INT',
                'unsigned' => TRUE,
            ],
            'archived_by'=> [
                'type'=> 'INT',
                'unsigned' => TRUE,
            ],
            'deleted_by' => [
                'type'=> 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'deleted_at' => [
                'type'=> 'DATETIME',
                'null'=> true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'archived_at' => [
                'type'=> 'DATETIME',
                'null'=> true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('series_id', 'record_series', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('deleted_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users','id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'record_statuses','id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('records');
    }

    public function down()
    {
        $this->forge->dropTable('records');
    }
}

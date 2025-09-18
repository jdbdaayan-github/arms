<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordStatusesTable extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id'=> ['type'=> 'INT',
                'constraint'=> 11,
                'unsigned'=> true,
                'auto_incement'=> true,
            ],
            'name'=> [
                'type'=> 'VARCHAR',
                'constraint' => 50,
            ],
            'description'=> [
                'type'=> 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('record_statuses');
    }

    public function down()
    {
        $this->forge->dropTable('record_statuses');
    }
}

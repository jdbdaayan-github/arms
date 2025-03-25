<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDirectorateTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'directorateID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'directorateCode' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'directorateName' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('directorateID');
        $this->forge->createTable('directorates');
    }

    public function down()
    {
        $this->forge->dropTable('directorates');
    }
}

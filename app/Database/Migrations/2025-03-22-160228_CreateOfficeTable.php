<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfficeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'officeID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'officeCode' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
            ],
            'officeName' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'directorate_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addPrimaryKey('officeID');
        $this->forge->addForeignKey('directorate_id', 'directorates', 'directorateID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('offices');
    }

    public function down()
    {
        $this->forge->dropTable('offices');
    }
}

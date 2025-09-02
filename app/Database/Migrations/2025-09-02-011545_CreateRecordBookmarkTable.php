<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecordBookmarkTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'      => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'=> true,
            ],
            'record_id'    => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null' => true,
            ],
            'created_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('record_id', 'records', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('record_bookmarks');
    }

    public function down()
    {
        $this->forge->dropTable('record_bookmarks');
    }
}

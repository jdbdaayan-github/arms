<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DirectoratesSeeder::class);
        $this->call(OfficesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RecordStatusesSeeder::class);
        $this->call(RecordClassificationsSeeder::class);
        $this->call(RecordCategoriesSeeder::class);
        $this->call(UserStatusesSeeder::class);
        $this->call(SuperusersSeeder::class);
    }
}

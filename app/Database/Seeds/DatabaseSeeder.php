<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(RecordClassificationSeeder::class);
        $this->call(RecordSeriesSeeder::class);
        $this->call(RecordIndexSeeder::class);
        $this->call(RecordSeriesIndexSeeder::class);
        $this->call(RecordStatusSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(UserTesterSeeder::class);
    }
}

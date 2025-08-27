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
    }
}

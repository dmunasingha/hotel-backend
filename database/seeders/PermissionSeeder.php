<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            ['name' => 'manage users', 'guard_name' => 'web'],
            ['name' => 'create users', 'guard_name' => 'web'],
            ['name' => 'edit users', 'guard_name' => 'web'],
            ['name' => 'delete users', 'guard_name' => 'web'],
            ['name' => 'manage roles', 'guard_name' => 'web'],
            ['name' => 'create roles', 'guard_name' => 'web'],
            ['name' => 'edit roles', 'guard_name' => 'web'],
            ['name' => 'delete roles', 'guard_name' => 'web'],
        ];

        foreach ($data as $value) {
            Permission::firstOrCreate($value);
        }
    }
}

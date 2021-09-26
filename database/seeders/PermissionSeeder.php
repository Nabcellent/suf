<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $roles = [ 'Admin', 'Seller', 'Customer' ];
        $permissions = [
            'create user', 'create product', 'create banner', 'create brand', 'create admin',
            'update category', 'update product',
        ];

        foreach($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

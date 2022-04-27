<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
                'name' => 'Opik',
                'email' => 'opik@gmail.com',
                'password' => bcrypt('rahasia123'),
            ],
            [
                'name' => 'fina',
                'email' => 'fina@gmail.com',
                'password' => bcrypt('rahasia123'),
            ],
            [
                'name' => 'alna',
                'email' => 'alna@gmail.com',
                'password' => bcrypt('rahasia123'),
            ],
            [
                'name' => 'taofik',
                'email' => 'taofik@gmail.com',
                'password' => bcrypt('rahasia123'),
            ]
        );

        Role::create([
                'name' => 'super admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'writer',
                'guard_name' => 'web',
            ]
        );

        Permission::create([
                'name' => 'create arsip',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show users',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete arsip',
                'guard_name' => 'web',
            ]
        );
    }
}

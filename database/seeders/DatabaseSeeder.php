<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\JenisArsip;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Unit;
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
        $this->call(UnitTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        
        $this->call(JenisTableSeeder::class);
        $this->call(JenisArsipTableSeeder::class);
        $user = User::find(1);
        $user->assignRole('super admin');

        $user = User::find(2);
        $user->assignRole('admin');

        $user = User::find(3);
        $user->assignRole('writer');
        
        
    }
}

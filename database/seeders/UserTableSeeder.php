<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user default
        User::create([
            'name' => 'Opik',
            'email' => 'opik@gmail.com',
            'username' => 'opik21',
            'password' => bcrypt('rahasia123'),
            'unit_id' => 1,
        ]);

        User::create([
            'name' => 'fina',
            'email' => 'fina@gmail.com',
            'username' => 'fina21',
            'password' => bcrypt('rahasia123'),
            'unit_id' => 2,
        ]);

        User::create([
            'name' => 'alna',
            'email' => 'alna@gmail.com',
            'username' => 'alna21',
            'password' => bcrypt('rahasia123'),
            'unit_id' => 3,
        ]);

        User::create([
            'name' => 'taofik',
            'email' => 'taofik@gmail.com',
            'username' => 'taofik21',
            'password' => bcrypt('rahasia123'),
            'unit_id' => 5,
        ]);
    }
}

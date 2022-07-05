<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Seeder;

class JenisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenis::create([
            'name' => 'KU',
            'description' => 'lorem',
        ]);

        Jenis::create([
            'name' => 'HK',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'UM',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'PR',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'SA',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'KJ',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'IP',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'KP',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'OR',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'PD',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'PW',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'AT',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'IR',
            'description' => 'lorem',

        ]);

        Jenis::create([
            'name' => 'PP',
            'description' => 'lorem',

        ]);

        
        Jenis::create([
            'name' => 'RW',
            'description' => 'lorem',

        ]);


        Jenis::create([
            'name' => 'SI',
            'description' => 'lorem',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{Utilisateur};

class RootTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Utilisateur::firstOrCreate([
            'nom' => 'Admin',
            'login' => 'admin',
        	'password' => Hash::make('Carter@2020'),
        ]);

        Utilisateur::firstOrCreate([
            'nom' => 'Doukoure',
            'login' => 'sao',
            'password' => Hash::make('123456789'),
        ]);
    }
}

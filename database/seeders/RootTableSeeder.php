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
        DB::table('utilisateur')->insert([
            ['nom' => 'Youssouf Donzo', 'login' => 'donzo@evil.com', 'password' => Hash::make('123456789')],
            'nom' => 'Doukoure', 'login' => 'doukoure@evil.com', 'password' => Hash::make('123456789')
        ]);
    }
}

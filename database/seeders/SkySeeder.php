<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SkySeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'sky zeus',
            'email' => 'sky@zeus.com',
            'password' => Hash::make('123456789'),
        ]);

        $this->call([
            PostSeeder::class,
        ]);
    }
}
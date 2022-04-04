<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaraZeus\Sky\Models\Post;

class SkySeeder extends Seeder
{
    public function run()
    {
        Post::factory()
            ->count(8)
            ->create();
    }
}

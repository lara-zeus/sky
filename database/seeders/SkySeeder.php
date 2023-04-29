<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SkySeeder extends Seeder
{
    public function run()
    {
        config('zeus-sky.models.tag')::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        config('zeus-sky.models.tag')::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        config('zeus-sky.models.tag')::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        config('zeus-sky.models.post')::factory()
            ->count(8)
            ->create();

        foreach (config('zeus-sky.models.post')::all() as $post) { // loop through all posts
            $random_tags = config('zeus-sky.models.tag')::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }
    }
}

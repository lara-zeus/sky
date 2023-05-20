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

        foreach (config('zeus-sky.models.post')::all() as $post) {
            $random_tags = config('zeus-sky.models.tag')::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        config('zeus-sky.models.tag')::create(['name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library']);
        config('zeus-sky.models.tag')::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        config('zeus-sky.models.library')::factory()
            ->count(8)
            ->create();

        foreach (config('zeus-sky.models.library')::all() as $library) {
            $random_tags = config('zeus-sky.models.tag')::getWithType('library')->random(1)->first()->name;
            $library->syncTagsWithType([$random_tags], 'library');
        }
    }
}

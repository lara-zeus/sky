<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\SkyPlugin;

class SkySeeder extends Seeder
{
    public function run(): void
    {
        SkyPlugin::get()->getTagModel()::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        SkyPlugin::get()->getTagModel()::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        SkyPlugin::get()->getTagModel()::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        SkyPlugin::get()->getPostModel()::factory()
            ->count(8)
            ->create();

        foreach (SkyPlugin::get()->getPostModel()::all() as $post) {
            $random_tags = SkyPlugin::get()->getTagModel()::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        SkyPlugin::get()->getTagModel()::create(['name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library']);
        SkyPlugin::get()->getTagModel()::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        SkyPlugin::get()->getLibraryModel()::factory()
            ->count(8)
            ->create();

        foreach (SkyPlugin::get()->getLibraryModel()::all() as $library) {
            $random_tags = SkyPlugin::get()->getTagModel()::getWithType('library')->random(1)->first()->name;
            $library->syncTagsWithType([$random_tags], 'library');
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\SkyPlugin;

class SkySeeder extends Seeder
{
    public function run(): void
    {
        SkyPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        SkyPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        SkyPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        SkyPlugin::get()->getModel('Post')::factory()
            ->count(8)
            ->create();

        foreach (SkyPlugin::get()->getModel('Post')::all() as $post) {
            $random_tags = SkyPlugin::get()->getModel('Tag')::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        SkyPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library']);
        SkyPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        SkyPlugin::get()->getModel('Library')::factory()
            ->count(8)
            ->create();

        foreach (SkyPlugin::get()->getModel('Library')::all() as $library) {
            $random_tags = SkyPlugin::get()->getModel('Tag')::getWithType('library')->random(1)->first()->name;
            $library->syncTagsWithType([$random_tags], 'library');
        }
    }
}

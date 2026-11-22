<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use LaraZeus\Sky\SkyPlugin;

class SkySeeder extends Seeder
{
    public function run(): void
    {
        /** @var class-string<Tag> $tagModel */
        $tagModel = SkyPlugin::get()->getModel('Tag');
        /** @var class-string<Post> $postModel */
        $postModel = SkyPlugin::get()->getModel('Post');
        /** @var class-string<Library> $libraryModel */
        $libraryModel = SkyPlugin::get()->getModel('Library');

        $tagModel::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        $tagModel::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        $tagModel::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        $postModel::factory()
            ->count(8)
            ->create();

        foreach ($postModel::all() as $post) {
            $random_tags = $tagModel::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        $tagModel::create(['name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library']);
        $tagModel::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        $libraryModel::factory()
            ->count(8)
            ->create();

        foreach ($libraryModel::all() as $library) {
            /** @var Tag $randomTag */
            $randomTag = $tagModel::getWithType('library')->random(1)->first();
            $library->syncTagsWithType([$randomTag->name], 'library');
        }
    }
}

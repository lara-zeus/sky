<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

class SkySeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => ['en'=>'laravel', 'ar'=>'لارافل'], 'type' => 'category']);
        Tag::create(['name' => ['en'=>'talks', 'ar'=>'اخبار'], 'type' => 'category']);
        Tag::create(['name' => ['en'=>'dev', 'ar'=>'تطوير'], 'type' => 'category']);

        Post::factory()
            ->count(8)
            ->create();

        foreach (Post::all() as $post) { // loop through all posts
            $random_tags = Tag::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }
    }
}

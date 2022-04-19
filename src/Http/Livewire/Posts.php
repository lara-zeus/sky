<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use Livewire\Component;

class Posts extends Component
{
    public function render()
    {
        return view(app('theme').'.home')
            ->with([
                'posts' => Post::NotSticky()->orderBy('published_at', 'desc')->get(),
                'pages' => Post::page()->orderBy('published_at', 'desc')->whereNull('parent_id')->get(),
                'tags' => Tag::withCount('postsPublished')->where('type', 'category')->get(), // $this->tag->postsPublished
                'stickies' => Post::sticky()->get(),
                'recent' => Post::posts()->take(5)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

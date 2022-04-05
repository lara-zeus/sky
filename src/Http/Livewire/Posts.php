<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class Posts extends Component
{
    public function render()
    {
        return view('zeus-sky::blogs.list')
            ->with([
                'posts' => Post::NotSticky()->orderBy('published_at','desc')->get(),
                'tags' => Tag::withCount('posts')->where('type', 'category')->get(),
                'stickies' => Post::sticky()->get(),
                'recent' => Post::take(5)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use Livewire\Component;

class Posts extends Component
{
    use SearchHelpers;

    public function render()
    {
        $search = request('search');
        $category = request('category');

        $posts = Post::NotSticky()
            ->Search($search)
            ->ForCatogery($category)
            ->orderBy('published_at', 'desc')
            ->get();

        $pages = Post::page()
            ->Search($search)
            ->ForCatogery($category)
            ->orderBy('published_at', 'desc')
            ->whereNull('parent_id')
            ->get();

        $pages = $this->highlightSearchResults($pages, $search);
        $posts = $this->highlightSearchResults($posts, $search);

        $recent = Post::posts()
            ->limit(config('zeus-sky.site_recent_count', 5))
            ->orderBy('published_at', 'desc')
            ->get();

        seo()
            ->title(__('Posts'))
            ->description(__('Posts') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('theme') . '.home')
            ->with([
                'posts' => $posts,
                'pages' => $pages,
                'recent' => $recent,
                'tags' => Tag::withCount('postsPublished')->where('type', 'category')->get(),
                'stickies' => Post::sticky()->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

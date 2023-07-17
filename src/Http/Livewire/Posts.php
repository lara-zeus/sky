<?php

namespace LaraZeus\Sky\Http\Livewire;

use Livewire\Component;

class Posts extends Component
{
    use SearchHelpers;

    public function render()
    {
        $search = request('search');
        $category = request('category');

        $posts = config('zeus-sky.models.post')::NotSticky()
            ->search($search)
            ->forCategory($category)
            ->published()
            ->orderBy('published_at', 'desc')
            ->get();

        $pages = config('zeus-sky.models.post')::page()
            ->search($search)
            ->forCategory($category)
            ->orderBy('published_at', 'desc')
            ->whereNull('parent_id')
            ->get();

        $pages = $this->highlightSearchResults($pages, $search);
        $posts = $this->highlightSearchResults($posts, $search);

        $recent = config('zeus-sky.models.post')::posts()
            ->published()
            ->limit(config('zeus-sky.site_recent_count', 5))
            ->orderBy('published_at', 'desc')
            ->get();

        seo()
            ->title(config('zeus-sky.site_title', 'Laravel') . ' ' . __('Posts'))
            ->description(__('Posts') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.home')->with([
            'posts' => $posts,
            'pages' => $pages,
            'recent' => $recent,
            'tags' => config('zeus-sky.models.tag')::withCount('postsPublished')->where('type', 'category')->get(),
            'stickies' => config('zeus-sky.models.post')::sticky()->published()->get(),
        ])
            ->layout(config('zeus.layout'));
    }
}

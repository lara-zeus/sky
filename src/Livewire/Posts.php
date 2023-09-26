<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\View\View;
use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Posts extends Component
{
    use SearchHelpers;

    public function render(): View
    {
        $search = request('search');
        $category = request('category');

        $posts = SkyPlugin::get()->getModel('Post')::NotSticky()
            ->search($search)
            ->with(['tags', 'author', 'media'])
            ->forCategory($category)
            ->published()
            ->orderBy('published_at', 'desc')
            ->get();

        $pages = SkyPlugin::get()->getModel('Post')::page()
            ->search($search)
            ->with(['tags', 'author', 'media'])
            ->forCategory($category)
            ->orderBy('published_at', 'desc')
            ->whereNull('parent_id')
            ->get();

        $pages = $this->highlightSearchResults($pages, $search);
        $posts = $this->highlightSearchResults($posts, $search);

        $recent = SkyPlugin::get()->getModel('Post')::posts()
            ->published()
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();

        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('Posts') . ' - ' . config('zeus.site_title'))
            ->description(__('Posts') . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.home')
            ->with([
                'posts' => $posts,
                'pages' => $pages,
                'recent' => $recent,
                'tags' => SkyPlugin::get()->getModel('Tag')::withCount('postsPublished')
                    ->where('type', 'category')
                    ->get(),
                'stickies' => SkyPlugin::get()->getModel('Post')::with(['author', 'media'])->sticky()->published()->get(),
            ])
            ->layout(config('zeus.layout'));
    }
}

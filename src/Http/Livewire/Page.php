<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $page;

    public function mount($slug)
    {
        $this->page = Post::where('slug',$slug)->page()->firstOrFail();
    }

    public function render()
    {
        if (! $this->page->getMedia('pages')->isEmpty()) {
            seo()->image($this->page->getFirstMediaUrl('pages'));
        }

        seo()
            ->title($this->page->title)
            ->description(($this->page->description ?? '') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('theme') . '.page')
            ->with([
                'post' => $this->page,
                /** @phpstan-ignore-next-line */
                'children' => Post::with('parent')->where('parent_id', $this->page->id)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

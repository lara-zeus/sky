<?php

namespace LaraZeus\Sky\Http\Livewire;

use Livewire\Component;

class Page extends Component
{
    public $page;

    public function mount($slug)
    {
        $this->page = config('zeus-sky.models.post')::where('slug', $slug)->page()->firstOrFail();

        if ($this->page->status !== 'publish') {
            abort_if(! auth()->check(), 404);
            abort_if($this->page->user_id !== auth()->user()->id, 401);
        }
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
                'children' => config('zeus-sky.models.post')::with('parent')->where('parent_id', $this->page->id)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

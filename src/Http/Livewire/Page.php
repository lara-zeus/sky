<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $page;

    public function mount($slug)
    {
        $this->page = Post::whereSlug($slug)->page()->firstOrFail();
    }

    public function render()
    {
        if (! $this->page->getMedia('pages')->isEmpty()) {
            seo()->image($this->page->getFirstMediaUrl('pages'));
        }
        seo()
            ->title($this->page->title)
            ->description($this->page->description)
            ->twitter();

        return view(app('theme').'.page')
            ->with([
                'post' => $this->page,
                'children' => Post::with('parent')->where('parent_id', $this->page->id)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

<?php

namespace LaraZeus\Sky\Http\Livewire;

use Livewire\Component;

class LibraryItem extends Component
{
    public $item;

    public function mount($slug)
    {
        $this->item = config('zeus-sky.models.library')::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        seo()
            ->title($this->item->title . ' - ' . __('Library'))
            ->description($this->item->description . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.library-item')
            ->with('library', $this->item)
            ->layout(config('zeus.layout'));
    }
}

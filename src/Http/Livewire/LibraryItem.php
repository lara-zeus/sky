<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class LibraryItem extends Component
{
    public $item;

    public function mount($slug)
    {
        $this->item = SkyPlugin::get()->getLibraryModel()::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->item->title . ' - ' . __('Library') . ' - ' . config('zeus.site_title'))
            ->description($this->item->description . ' ' . config('zeus.site_description', 'Laravel') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.library-item')
            ->with('library', $this->item)
            ->layout(config('zeus.layout'));
    }
}

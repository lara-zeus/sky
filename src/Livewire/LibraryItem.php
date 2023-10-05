<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class LibraryItem extends Component
{
    public \LaraZeus\Sky\Models\Library $item;

    public function mount(string $slug): void
    {
        $this->item = config('zeus-sky.models.Library')::where('slug', $slug)->firstOrFail();
    }

    public function render(): View
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

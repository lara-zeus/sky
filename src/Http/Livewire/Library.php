<?php

namespace LaraZeus\Sky\Http\Livewire;

use Illuminate\View\View;
use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Library extends Component
{
    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('libraries') . ' - ' . config('zeus.site_title'))
            ->description(__('Libraries') . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.library')
            ->with('libraries', SkyPlugin::get()->getLibraryModel()::get())
            ->with('categories', SkyPlugin::get()->getTagModel()::getWithType('library'))
            ->layout(config('zeus.layout'));
    }
}

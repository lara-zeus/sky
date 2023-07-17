<?php

namespace LaraZeus\Sky\Http\Livewire;

use Livewire\Component;

class Library extends Component
{
    public function render()
    {
        seo()
            ->title(__('Library'))
            ->description(__('Libraries') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.library')
            ->with('libraries', config('zeus-sky.models.library')::get())
            ->with('categories', config('zeus-sky.models.tag')::getWithType('library'))
            ->layout(config('zeus.layout'));
    }
}

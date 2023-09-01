<?php

namespace LaraZeus\Sky\Http\Livewire;

use Illuminate\View\View;
use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Faq extends Component
{
    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('FAQ') . ' - ' . config('zeus.site_title'))
            ->description(__('FAQs') . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.faq')
            ->with('faqs', SkyPlugin::get()->getFaqModel()::get())
            ->layout(config('zeus.layout'));
    }
}

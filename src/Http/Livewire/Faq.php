<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        seo()
            ->title(__('FAQ'))
            ->description(__('FAQs') . ' ' . config('zeus.site_description', 'Laravel'))
            ->site(config('zeus.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.faq')
            ->with('faqs', SkyPlugin::get()->getFaqModel()::get())
            ->layout(config('zeus.layout'));
    }
}

<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Faq as Faqs;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        seo()
            ->title(__('FAQ'))
            ->description(__('FAQs').' '.config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="'.asset('favicon/favicon.ico').'">')
            ->rawTag('<meta name="theme-color" content="'.config('zeus-sky.site_color').'" />')
            ->withUrl()
            ->twitter();

        return view(app('theme').'.addons.faq')
            ->with('faqs', Faqs::get())
            ->layout(config('zeus-sky.layout'));
    }
}

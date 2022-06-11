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
            ->description(__('FAQ description'))
            ->twitter();

        return view(app('theme').'.addons.faq')
            ->with('faqs' , Faqs::get())
            ->layout(config('zeus-sky.layout'));
    }
}

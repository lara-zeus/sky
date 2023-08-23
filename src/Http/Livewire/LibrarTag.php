<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class LibrarTag extends Component
{
    public $tag;

    public function mount($slug)
    {
        $this->tag = SkyPlugin::get()->getTagModel()::findBySlug($slug, 'library');

        abort_if($this->tag === null, 404);
    }

    public function render()
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->tag->name . ' - ' . __('Library') . ' - '.config('zeus.site_title', 'Laravel'))
            ->description($this->tag->description .' - '.config('zeus.site_description').' '.config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.addons.library-tag')
            ->with('libraryTag', $this->tag)
            ->layout(config('zeus.layout'));
    }
}

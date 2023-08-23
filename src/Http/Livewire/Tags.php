<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Tags extends Component
{
    public $type;

    public $slug;

    public $tag;

    public function mount($type, $slug)
    {
        $this->type = $type;
        $this->slug = $slug;
        $this->tag = SkyPlugin::get()->getTagModel()::findBySlug($slug, $type);

        abort_if($this->tag === null, 404);
    }

    public function render()
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->tag->name . ' - ' . config('zeus.site_title'))
            ->description(__('Show All posts in') . ' ' . $this->tag->name . ' - ' . config('zeus.site_description') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.category')
            ->with([
                'posts' => $this->tag->postsPublished,
            ])
            ->layout(config('zeus.layout'));
    }
}

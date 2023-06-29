<?php

namespace LaraZeus\Sky\Http\Livewire;

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
        $this->tag = config('zeus-sky.models.tag')::findBySlug($slug, $type);

        abort_if($this->tag === null, 404);
    }

    public function render()
    {
        seo()
            ->title($this->tag->name)
            ->site(config('app.name', 'Laravel'))
            ->description(config('zeus-sky.site_description') . ' ' . __('Show All posts in') . ' ' . $this->tag->name)
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('skyTheme') . '.category')
            ->with([
                'posts' => $this->tag->postsPublished,
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

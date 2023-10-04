<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\View\View;
use LaraZeus\Sky\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    public string $type;

    public string $slug;

    public ?Tag $tag;

    public function mount(string $type, string $slug): void
    {
        $this->type = $type;
        $this->slug = $slug;
        $this->tag = config('zeus-sky.models.Tag')::findBySlug($slug, $type);

        abort_if($this->tag === null, 404);
    }

    public function render(): View
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

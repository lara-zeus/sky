<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\View\View;
use LaraZeus\Sky\SkyPlugin;
use Livewire\Component;

class Post extends Component
{
    public \LaraZeus\Sky\Models\Post $post;

    public function mount(string $slug): void
    {
        $this->post = SkyPlugin::get()->getModel('Post')::where('slug', $slug)->firstOrFail();
    }

    public function render(): View
    {
        $this->setSeo();

        if ($this->post->status !== 'publish' && ! $this->post->require_password) {
            abort_if(! auth()->check(), 404);
            abort_if($this->post->user_id !== auth()->user()->id, 401);
        }

        if ($this->post->require_password && ! session()->has($this->post->slug . '-' . $this->post->password)) {
            return view(app('skyTheme') . '.partial.password-form')
                ->layout(config('zeus.layout'));
        }

        return view(app('skyTheme') . '.post')
            ->with('post', $this->post)
            ->with('related', SkyPlugin::get()->getModel('Post')::related($this->post)->take(4)->get())
            ->layout(config('zeus.layout'));
    }

    public function setSeo(): void
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($this->post->title . ' - ' . config('zeus.site_title'))
            ->description(($this->post->description ?? '') . ' ' . config('zeus.site_description', 'Laravel') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        if (! $this->post->getMedia('posts')->isEmpty()) {
            seo()->image($this->post->getFirstMediaUrl('posts'));
        }
    }
}

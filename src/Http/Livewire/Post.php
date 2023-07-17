<?php

namespace LaraZeus\Sky\Http\Livewire;

use Livewire\Component;

class Post extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = config('zeus-sky.models.post')::where('slug', $slug)->firstOrFail();
    }

    public function render()
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
            ->with('related', config('zeus-sky.models.post')::related($this->post)->take(4)->get())
            ->layout(config('zeus.layout'));
    }

    public function setSeo(): void
    {
        seo()
            ->title($this->post->title)
            ->description(($this->post->description ?? '') . ' ' . config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        if (! $this->post->getMedia('posts')->isEmpty()) {
            seo()->image($this->post->getFirstMediaUrl('posts'));
        }
    }
}

<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post as postModel;
use Livewire\Component;

class Post extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = postModel::whereSlug($slug)->firstOrFail();;
    }

    public function render()
    {
        if (! $this->post->getMedia('posts')->isEmpty()) {
            seo()->image($this->post->getFirstMediaUrl('posts'));
        }

        seo()
            ->title($this->post->title)
            ->description(($this->post->description ?? '').' '.config('zeus-sky.site_description', 'Laravel'))
            ->site(config('zeus-sky.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="'.asset('favicon/favicon.ico').'">')
            ->rawTag('<meta name="theme-color" content="'.config('zeus-sky.site_color').'" />')
            ->withUrl()
            ->twitter();

        return view(app('theme').'.post')
            ->with('post', $this->post)
            ->with('related', postModel::related($this->post)->take(4)->get())
            ->layout(config('zeus-sky.layout'));
    }
}

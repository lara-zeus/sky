<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post as postModel;
use Livewire\Component;

class Post extends Component
{
    public postModel $post;

    public function mount(postModel $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        if(!$this->post->getMedia('posts')->isEmpty()){
            seo()->image($this->post->getFirstMediaUrl('posts'));
        }
        seo()
            ->title($this->post->title)
            ->description($this->post->description)
            ->twitter();

        return view('zeus-sky::themes.'.config('zeus-sky.theme').'.post')
            ->with('post', $this->post)
            ->with('related', postModel::related($this->post)->take(4)->get())
            ->layout('zeus-sky::themes.'.config('zeus-sky.theme').'.layouts.app');
    }
}

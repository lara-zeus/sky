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
        return view('zeus-sky::blogs.show')
            ->with('post', $this->post)
            ->with('related', postModel::related($this->post)->take(4)->get())
            ->layout(config('zeus-sky.layout'))
            ;
    }
}

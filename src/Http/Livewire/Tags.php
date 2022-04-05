<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use Livewire\Component;

class Tags extends Component
{
    public $type;
    public $slug;

    public function mount($type, $slug)
    {
        $this->type = $type;
        $this->slug = $slug;
    }

    public function render()
    {
        return view('zeus-sky::blogs.category')
            ->with([
                'posts' => Post::withAllTags([$this->slug], $this->type)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
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
        $this->tag = Tag::findBySlug($slug,$type);
    }

    public function render()
    {
        seo()
            ->title($this->tag->name)
            ->description('Show All posts in '.$this->tag->name)
            ->twitter();

        return view('zeus-sky::blogs.category')
            ->with([
                'posts' => Post::withAllTags([$this->slug], $this->type)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

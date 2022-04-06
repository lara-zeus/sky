<?php

namespace LaraZeus\Sky\Http\Livewire;

use LaraZeus\Sky\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $page;

    public function mount($slug)
    {
        $this->page = Post::whereSlug($slug)->page()->firstOrFail();
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

        return view('zeus-sky::blogs.show')
            ->with([
                'post' => $this->page,
                'related' => Post::where('parent_id',$this->page->id)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

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
        //$children = AtmPost::with(['thumbnail', 'attachment'])->where('post_parent', $page->ID)->where('post_type', 'page')->get();
    }

    public function render()
    {
        return view('zeus-sky::blogs.show')
            ->with([
                'post' => $this->page,
                'related' => Post::where('parent_id',$this->page->id)->get(),
            ])
            ->layout(config('zeus-sky.layout'));
    }
}

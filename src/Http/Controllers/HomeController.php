<?php

namespace LaraZeus\Sky\Http\Controllers;

use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        return view('zeus-sky::blogs.list')
            ->with([
                'posts' => Post::NotSticky()->get(),
                'tags' => Tag::withCount('posts')->where('type', 'category')->get(),
                'stickies' => Post::sticky()->get(),
                'recent' => Post::take(5)->get(),
            ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('tags')->Published()->first();

        return view('zeus-sky::blogs.show')
            ->with('post', $post)
            ->with('related', post::related($post)->take(4)->inRandomOrder()->get());
    }

    public function page($slug)
    {
        $page = AtmPost::slug($slug)->published()->firstOrFail();
        $children = AtmPost::with(['thumbnail', 'attachment'])->where('post_parent', $page->ID)->where('post_type', 'page')->get();

        views($page)
            ->cooldown(now()->addHours(2))
            ->record();

        return view('blog.show', [
            'theMainPost' => $page,
            'children' => $children,
        ]);
    }

    public function cat($cat)
    {
        return view('blog.cat', [
            'getCat' => Taxonomy::category()->slug($cat)->firstOrFail(),
            'posts' => AtmPost::active('category', $cat, null)->get(),
        ]);
    }

    public function tag($tag)
    {
        return view('blog.cat', [
            'getCat' => Taxonomy::where('taxonomy', 'post_tag')->slug($tag)->firstOrFail(),
            'posts' => AtmPost::active('post_tag', $tag)->get(),
        ]);
    }

    public function passConf()
    {
        session()->put(request('postID').'-'.request('password'), request('password'));

        return redirect()->back()->with('status', 'sorry, password incorrect!');
    }
}

<?php

namespace LaraZeus\Sky\Http\Controllers;

use LaraZeus\Sky\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        return view('zeus-sky::blogs.list')
            ->with('posts',Post::get());
    }
}

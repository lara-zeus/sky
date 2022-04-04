<?php

namespace App\Http\Controllers;

use App\Models\AtmPost;

class SitemapXmlController extends Controller
{
    public function index()
    {
        $posts = AtmPost::newest()->type('post')->published()->get();
        $pages = AtmPost::newest()->type('page')->published()->get();

        return response()->view('blog.sitemap', [
            'posts' => $posts,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}

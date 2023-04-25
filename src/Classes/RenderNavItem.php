<?php

namespace LaraZeus\Sky\Classes;

use LaraZeus\Sky\Models\Post;

class RenderNavItem
{
    public static function render($item, $class = '')
    {
        if ($item['type'] === 'page-link') {
            $page = Post::page()->find($item['data']['page_id']) ?? '';
            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '" 
                    href="' . route('page', $page) . '"
                >' .
                $item['label'] .
                '</a>';
        } elseif ($item['type'] === 'post-link') {
            $post = Post::find($item['data']['post_id']) ?? '';
            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '" 
                    href="' . route('post', $post) . '"
                >' .
                $item['label'] .
                '</a>';
        } else {
            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '" 
                    href="' . $item['data']['url'] . '"
                >' .
                $item['label'] .
                '</a>';
        }
    }
}
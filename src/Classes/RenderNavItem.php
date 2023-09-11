<?php

namespace LaraZeus\Sky\Classes;

use LaraZeus\Sky\SkyPlugin;

class RenderNavItem
{
    public static function render(array $item, string $class = ''): string
    {
        $color = 'border-b border-b-secondary-500 text-secondary-500';

        if ($item['type'] === 'page-link' || $item['type'] === 'page_link') {
            $page = SkyPlugin::get()->getModel('Post')::page()->find($item['data']['page_id']) ?? '';
            $activeClass = (request()->routeIs('page', $page)) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('page', $page) . '"
                >' .
                $item['label'] .
                '</a>';
        } elseif ($item['type'] === 'post-link' || $item['type'] === 'post_link') {
            $post = SkyPlugin::get()->getModel('Post')::find($item['data']['post_id']) ?? '';
            $activeClass = (request()->routeIs('post', $post)) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('post', $post) . '"
                >' .
                $item['label'] .
                '</a>';
        } elseif ($item['type'] === 'library-link' || $item['type'] === 'library_link') {
            $tag = SkyPlugin::get()->getModel('Tag')::find($item['data']['library_id']) ?? '';
            $activeClass = (str(request()->url())->contains($tag->library->first()->slug)) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('library.tag', $tag->slug) . '"
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

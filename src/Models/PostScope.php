<?php

namespace LaraZeus\Sky\Models;

trait PostScope
{
    public function scopeSticky($query)
    {
        $query->wherePostType('post')
            ->whereNotNull('sticky_until')
            ->whereDate('sticky_until', '>=', now())
            ->whereDate('published_at', '<=', now());
    }

    public function scopeNotSticky($query)
    {
        $query->wherePostType('post')
            ->where(function ($q) {
                return $q->whereDate('sticky_until', '<=', now())->orWhereNull('sticky_until');
            })
            ->whereDate('published_at', '<=', now());
    }

    public function scopePublished($query)
    {
        $query->wherePostType('post')
            ->whereDate('published_at', '<=', now());
    }

    public function scopeRelated($query, $post)
    {
        $query->wherePostType('post')
            ->withAnyTags($post->tags->pluck('name')->toArray(), 'category');
    }

    public function scopePage($query)
    {
        $query->wherePostType('page')
            ->whereDate('published_at', '<=', now());
    }

    public function scopePosts($query)
    {
        $query->wherePostType('post')
            ->whereDate('published_at', '<=', now());
    }
}

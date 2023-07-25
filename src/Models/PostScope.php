<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait PostScope
{
    /**
     * @param  Builder<Post>  $query
     * @return Builder
     */
    public function scopeSticky(Builder $query): Builder
    {
        return $query->where('post_type', 'post')
            ->whereNotNull('sticky_until')
            ->whereDate('sticky_until', '>=', now())
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder
     */
    public function scopeNotSticky(Builder $query): Builder
    {
        return $query->where('post_type', 'post')->where(function ($q) {
            return $q->whereDate('sticky_until', '<=', now())->orWhereNull('sticky_until');
        })
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('post_type', 'post')
            ->where('status', 'publish')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @param  Post  $post
     * @return Builder
     */
    public function scopeRelated(Builder $query, Post $post): Builder
    {
        return $query->where('post_type', 'post')
            ->withAnyTags($post->tags->pluck('name')->toArray(), 'category');
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder
     */
    public function scopePage(Builder $query): Builder
    {
        return $query->where('post_type', 'page')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @return Builder
     */
    public function scopePosts(Builder $query): Builder
    {
        return $query->where('post_type', 'post')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @param  ?string  $category
     * @return Builder
     */
    public function scopeForCategory(Builder $query, string $category = null): Builder
    {
        if ($category !== null) {
            return $query->where(
                function ($query) use ($category) {
                    $query->withAnyTags([$category], 'category');

                    return $query;
                }
            );
        }

        return $query;
    }

    /**
     * @param  Builder<Post>  $query
     * @param $term
     * @return Builder
     */
    public function scopeSearch(Builder $query, $term): Builder
    {
        if ($term !== null) {
            return $query->where(
                function ($query) use ($term) {
                    foreach (['title', 'slug', 'content', 'description'] as $attribute) {
                        $query->orWhere(DB::raw("lower({$attribute})"), 'like', "%{$term}%");
                    }

                    return $query;
                }
            );
        }

        return $query;
    }
}

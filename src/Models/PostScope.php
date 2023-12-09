<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Builder;

trait PostScope
{
    /**
     * @param  Builder<Post>  $query
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
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('post_type', 'post')
            ->where('status', 'publish')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     */
    public function scopeRelated(Builder $query, Post $post): Builder
    {
        return $query->where('post_type', 'post')
            ->withAnyTags($post->tags->pluck('name')->toArray(), 'category');
    }

    /**
     * @param  Builder<Post>  $query
     */
    public function scopePage(Builder $query): Builder
    {
        return $query->where('post_type', 'page')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     */
    public function scopePosts(Builder $query): Builder
    {
        return $query->where('post_type', 'post')
            ->whereDate('published_at', '<=', now());
    }

    /**
     * @param  Builder<Post>  $query
     * @param  ?string  $category
     */
    public function scopeForCategory(Builder $query, ?string $category = null): Builder
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
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if ($term !== null) {
            return $query->where(
                function ($query) use ($term) {
                    foreach (['title', 'slug', 'content', 'description'] as $attribute) {
                        $query->orWhere($attribute, 'like', "%{$term}%");
                    }

                    return $query;
                }
            );
        }

        return $query;
    }
}

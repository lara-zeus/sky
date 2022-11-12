<?php

namespace LaraZeus\Sky\Models;

/**
 * @property string $slug
 * @property string $type
 * @property string $name
 */
class Tag extends \Spatie\Tags\Tag
{
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function postsPublished()
    {
        return $this->morphedByMany(Post::class, 'taggable')->published();
    }

    protected function generateSlug(string $locale): string
    {
        if ($this->slug !== null) {
            return $this->slug;
        }

        $slugger = config('tags.slugger');

        $slugger ??= '\Illuminate\Support\Str::slug';

        return call_user_func($slugger, $this->getTranslation('name', $locale));
    }

    public static function findBySlug(string $slug, string $type = null, string $locale = null)
    {
        $locale = $locale ?? static::getLocale();

        return static::query()
            ->where("slug->{$locale}", $slug)
            ->where('type', $type)
            ->first();
    }
}

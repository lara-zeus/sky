<?php

namespace LaraZeus\Sky\Models;

class Tag extends \Spatie\Tags\Tag
{
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
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
}

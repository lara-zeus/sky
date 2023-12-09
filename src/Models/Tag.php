<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property string $slug
 * @property string $type
 * @property string $name
 * @property string $description
 *
 * @method Builder|static published()
 */
class Tag extends \Spatie\Tags\Tag
{
    public function library(): MorphToMany
    {
        return $this->morphedByMany(config('zeus-sky.models.Library'), 'taggable');
    }

    public function category(): MorphToMany
    {
        return $this->morphedByMany(config('zeus-sky.models.Post'), 'taggable');
    }

    public function faq(): MorphToMany
    {
        return $this->morphedByMany(config('zeus-sky.models.Faq'), 'taggable');
    }

    public function tag(): MorphToMany
    {
        return $this->morphedByMany(config('zeus-sky.models.Post'), 'taggable');
    }

    /** @return MorphToMany<Post> */
    public function postsPublished(): MorphToMany
    {
        // @phpstan-ignore-next-line
        return $this->morphedByMany(config('zeus-sky.models.Post'), 'taggable')->published();
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

    public static function findBySlug(string $slug, ?string $type = null, ?string $locale = null): ?Model
    {
        $locale = $locale ?? static::getLocale();

        return static::query()
            ->where("slug->{$locale}", $slug)
            ->where('type', $type)
            ->first();
    }
}

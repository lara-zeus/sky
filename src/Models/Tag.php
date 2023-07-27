<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use LaraZeus\Sky\SkyPlugin;

/**
 * @property string $slug
 * @property string $type
 * @property string $name
 *
 * @method Builder|static published()
 */
class Tag extends \Spatie\Tags\Tag
{
    public function library(): MorphToMany
    {
        return $this->morphedByMany(SkyPlugin::get()->getLibraryModel(), 'taggable');
    }

    public function category(): MorphToMany
    {
        return $this->morphedByMany(SkyPlugin::get()->getPostModel(), 'taggable');
    }

    public function faq(): MorphToMany
    {
        return $this->morphedByMany(SkyPlugin::get()->getFaqModel(), 'taggable');
    }

    public function tag(): MorphToMany
    {
        return $this->morphedByMany(SkyPlugin::get()->getPostModel(), 'taggable');
    }

    /** @return MorphToMany<Post> */
    public function postsPublished(): MorphToMany
    {
        // @phpstan-ignore-next-line
        return $this->morphedByMany(SkyPlugin::get()->getPostModel(), 'taggable')->published();
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

    public static function findBySlug(string $slug, string $type = null, string $locale = null): ?Model
    {
        $locale = $locale ?? static::getLocale();

        return static::query()
            ->where("slug->{$locale}", $slug)
            ->where('type', $type)
            ->first();
    }
}

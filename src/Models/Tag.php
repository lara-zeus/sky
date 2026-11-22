<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property string | null $slug
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
        /** @var class-string<Library> $libraryModel */
        $libraryModel = config('zeus-sky.models.Library');

        return $this->morphedByMany($libraryModel, 'taggable');
    }

    public function category(): MorphToMany
    {
        /** @var class-string<Post> $postModel */
        $postModel = config('zeus-sky.models.Post');

        return $this->morphedByMany($postModel, 'taggable');
    }

    public function faq(): MorphToMany
    {
        /** @var class-string<Faq> $faqModel */
        $faqModel = config('zeus-sky.models.Faq');

        return $this->morphedByMany($faqModel, 'taggable');
    }

    public function tag(): MorphToMany
    {
        /** @var class-string<Post> $postModel */
        $postModel = config('zeus-sky.models.Post');

        return $this->morphedByMany($postModel, 'taggable');
    }

    /** @return MorphToMany<Post, $this> */
    public function postsPublished(): MorphToMany
    {
        /** @var class-string<Post> $postModel */
        $postModel = config('zeus-sky.models.Post');

        return $this->morphedByMany($postModel, 'taggable')->published();
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

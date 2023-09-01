<?php

namespace LaraZeus\Sky\Models;

use Database\Factories\LibraryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $file_path
 */
class Library extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use HasTranslations;
    use InteractsWithMedia;

    public array $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'slug',
        'title',
        'description',
        'file_path',
        'timestamps',
        'type',
    ];

    protected static function newFactory(): LibraryFactory
    {
        return LibraryFactory::new();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function theFile(): ?string
    {
        if (! $this->getMedia('library')->isEmpty()) {
            return $this->getFirstMediaUrl('library');
        }

        return $this->file_path;
    }

    /** Collection<mixed, mixed> */
    public function getFiles(): MediaCollection | Collection
    {
        if (! $this->getMedia('library')->isEmpty()) {
            return $this->getMedia('library');
        }

        return Collection::empty();
    }
}

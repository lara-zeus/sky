<?php

namespace LaraZeus\Sky\Models;

use Database\Factories\LibraryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property Carbon $file
 */
class Library extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
    use HasTranslations;

    public $translatable = [
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function theFile()
    {
        if (! $this->getMedia('library')->isEmpty()) {
            return $this->getFirstMediaUrl('library');
        }

        return $this->file_path;
    }
}

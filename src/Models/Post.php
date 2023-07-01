<?php

namespace LaraZeus\Sky\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $title
 * @property string $content
 * @property string $description
 * @property Carbon $published_at
 * @property string $status
 * @property string $slug
 * @property string $post_type
 * @property int $user_id
 * @property bool $require_password
 * @property string $password
 */
class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
    use PostScope;
    use HasTranslations;

    public $translatable = [
        'title',
        'content',
        'description',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'post_type',
        'content',
        'user_id',
        'parent_id',
        'featured_image',
        'published_at',
        'sticky_until',
        'password',
        'ordering',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'sticky_until' => 'datetime',
    ];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function statusDesc(): string
    {
        $PostStatus = config('zeus-sky.models.postStatus')::where('name', $this->status)->first();
        $icon = Blade::render('@svg("' . $PostStatus->icon . '","w-4 h-4 inline-flex")');

        return "<span title='" . __('post status') . "' class='$PostStatus->class'> " . $icon . " {$PostStatus->label}</span>";
    }

    public function author()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function image()
    {
        if (! $this->getMedia('posts')->isEmpty()) {
            return $this->getFirstMediaUrl('posts');
        } else {
            return $this->featured_image ?? config('zeus-sky.default_featured_image', null);
        }
    }

    protected function requirePassword(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === 'private' && $this->password !== null,
        );
    }

    public function getContent(): string
    {
        return $this->parseContent(config('zeus-sky.editor')::render($this->content));
    }

    public function parseContent($content): string
    {
        $parsers = config('zeus-sky.parsers');

        if (! empty($parsers)) {
            foreach ($parsers as $parser) {
                $content = (new $parser)($content);
            }
        }

        return $content;
    }
}

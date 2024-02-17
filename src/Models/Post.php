<?php

namespace LaraZeus\Sky\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
 *
 * @method Builder|static sticky()
 * @method Builder|static published()
 * @method Builder|static query()
 * @method Builder|static withAnyTags()
 */
class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use HasTranslations;
    use InteractsWithMedia;
    use PostScope;
    use SoftDeletes;

    public array $translatable = [
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
        $PostStatus = config('zeus-sky.models.PostStatus')::where('name', $this->status)->first();
        $icon = Blade::render('@svg("' . $PostStatus->icon . '","w-4 h-4 inline-flex")');

        return "<span title='" . __('post status') . "' class='$PostStatus->class'> " . $icon . " {$PostStatus->label}</span>";
    }

    /** @return BelongsTo<Post, Model> */
    public function author(): BelongsTo
    {
        // return $this->belongsTo(config('auth.providers.users.model'), 'user_id', 'id');
        // To acocomodate using LDAPRecord ( https://ldaprecord.com/docs/laravel/v3/auth/database/configuration#introduction ) the belongs to relation needs to look back at the database model rather than the LDAP model.  The LDAP model itself doesn't have provision for
        // the belongsTo relationship and instead gives an error from the Spatie permissions side: LDAP RECORD with Spatie Permissions gives error "The LDAP connection [mysql] does not exist."
        return $this->belongsTo(! empty(config('auth.providers.users.database.model')) ? config('auth.providers.users.database.model') : config('auth.providers.users.model'), 'user_id', 'id');

    }

    /** @return BelongsTo<Post, Post> */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function image(string $collection = 'posts'): Collection | string | null
    {
        if (! $this->getMedia($collection)->isEmpty()) {
            return $this->getFirstMediaUrl($collection);
        } else {
            return $this->featured_image ?? config('zeus-sky.defaultFeaturedImage');
        }
    }

    /**
     * @return Attribute<int, never>
     */
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

    public function parseContent(string $content): string
    {
        $parsers = config('zeus-sky.parsers');

        if (filled($parsers)) {
            foreach ($parsers as $parser) {
                $content = (new $parser)($content);
            }
        }

        return $content;
    }
}

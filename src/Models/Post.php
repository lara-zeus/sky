<?php

namespace LaraZeus\Sky\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Post extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia, PostScope, HasTranslations;

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
        $PostStatus = PostStatus::where('name', $this->status)->first();
        $icon = Blade::render('@svg("'.$PostStatus->icon.'","w-4 h-4 inline-flex")');

        return "<span title='".__('post status')."' class='px-2 py-0.5 text-xs rounded-xl text-{$PostStatus->class}-700 bg-{$PostStatus->class}-500/10'> ".$icon." {$PostStatus->label}</span>";
    }

    public function author()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}

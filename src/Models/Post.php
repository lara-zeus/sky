<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia;

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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\PostFactory::new();
    }

    protected function statusDesc(): Attribute
    {
        $PostStatus = PostStatus::where('name', $this->status)->first();
        return new Attribute(
            get: fn($value) => "<span title='post status' class='px-2 py-0.5 text-xs rounded-xl text-{$PostStatus->class}-700 bg-{$PostStatus->class}-500/10'>{$PostStatus->label}</span>",
        );
    }

    public function auther()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id', 'id');
    }
}

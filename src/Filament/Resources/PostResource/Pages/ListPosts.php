<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Models\Post;

class ListPosts extends ListRecords
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getTableQuery(): Builder
    {
        return Post::wherePostType('post');
    }
}

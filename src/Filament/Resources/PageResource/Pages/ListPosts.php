<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use Illuminate\Database\Eloquent\Builder;
use LaraZeus\Sky\Filament\Resources\PageResource;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Models\Post;

class ListPosts extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getTableQuery(): Builder
    {
        return Post::wherePostType('page');
    }
}

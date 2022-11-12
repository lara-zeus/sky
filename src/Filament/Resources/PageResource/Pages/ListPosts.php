<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Models\Post;

class ListPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function getTableQuery(): Builder
    {
        return Post::where('post_type','page');
    }
}

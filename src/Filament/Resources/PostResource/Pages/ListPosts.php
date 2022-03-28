<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Models\Post;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getTableRecordUrlUsing(): \Closure|null
    {
        return null;
    }
}

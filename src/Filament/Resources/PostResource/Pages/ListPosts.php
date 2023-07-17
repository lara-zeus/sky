<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Sky\Filament\Resources\PostResource;

class ListPosts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return config('zeus-sky.models.post')::query()
            ->where('post_type', 'post')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

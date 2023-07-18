<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\TagResource;

class ListTags extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TagResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}

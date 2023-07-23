<?php

namespace LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use Filament\Actions;

class EditLibrary extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = LibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}

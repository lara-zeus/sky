<?php

namespace LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\LibraryResource;

class ListLibrary extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = LibraryResource::class;
}

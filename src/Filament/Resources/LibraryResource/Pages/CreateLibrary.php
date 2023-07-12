<?php

namespace LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Sky\Filament\Resources\LibraryResource;

class CreateLibrary extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = LibraryResource::class;
}

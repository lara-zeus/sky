<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\TagResource;

class ListTags extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TagResource::class;
}

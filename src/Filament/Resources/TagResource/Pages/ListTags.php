<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use LaraZeus\Sky\Filament\Resources\TagResource;
use Filament\Resources\Pages\ListRecords;

class ListTags extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TagResource::class;
}

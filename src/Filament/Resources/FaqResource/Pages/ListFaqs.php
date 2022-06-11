<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\FaqResource;

class ListFaqs extends ListRecords
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

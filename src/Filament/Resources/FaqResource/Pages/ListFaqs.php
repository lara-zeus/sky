<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use Filament\Resources\Pages\ListRecords;

class ListFaqs extends ListRecords
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

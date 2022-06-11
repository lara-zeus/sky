<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use LaraZeus\Sky\Filament\Resources\FaqResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateFaq extends CreateRecord
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

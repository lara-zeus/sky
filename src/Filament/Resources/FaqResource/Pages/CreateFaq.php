<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\FaqResource;

class CreateFaq extends CreateRecord
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

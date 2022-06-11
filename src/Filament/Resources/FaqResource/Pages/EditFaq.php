<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use LaraZeus\Sky\Filament\Resources\FaqResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class EditFaq extends EditRecord
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

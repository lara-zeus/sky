<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\FaqResource;

class EditFaq extends EditRecord
{
    use Translatable;

    protected static string $resource = FaqResource::class;
}

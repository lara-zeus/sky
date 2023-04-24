<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\FaqResource;

class EditFaq extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FaqResource::class;
}

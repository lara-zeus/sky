<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use LaraZeus\Sky\Filament\Resources\TagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = TagResource::class;
}

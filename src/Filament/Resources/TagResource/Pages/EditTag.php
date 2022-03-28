<?php

namespace LaraZeus\Sky\Filament\Resources\TagResource\Pages;

use LaraZeus\Sky\Filament\Resources\TagResource;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = TagResource::class;
}

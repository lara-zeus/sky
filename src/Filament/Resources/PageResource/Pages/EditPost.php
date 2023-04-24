<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\PageResource;

class EditPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PageResource::class;
}

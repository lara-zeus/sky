<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\PageResource;

class EditPost extends EditRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;
}

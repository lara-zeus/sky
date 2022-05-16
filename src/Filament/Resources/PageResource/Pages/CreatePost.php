<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\PageResource;

class CreatePost extends CreateRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;
}

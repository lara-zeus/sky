<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\PostResource;

class CreatePost extends CreateRecord
{
    use Translatable;

    protected static string $resource = PostResource::class;
}

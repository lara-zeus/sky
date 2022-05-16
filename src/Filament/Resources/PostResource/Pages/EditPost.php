<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use LaraZeus\Sky\Filament\Resources\PostResource;

class EditPost extends EditRecord
{
    use Translatable;

    protected static string $resource = PostResource::class;
}

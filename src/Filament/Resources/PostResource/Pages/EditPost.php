<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\Sky\Filament\Resources\PostResource;

class EditPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;
}

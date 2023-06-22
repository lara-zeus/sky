<?php

namespace LaraZeus\Sky\Classes;

use Filament\Forms\Components\Component;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor as TinyEditorAlias;

class TinyEditor implements ContentEditor
{
    public static function component(): Component
    {
        return TinyEditorAlias::make('content')
            ->label(__('Post Content'))
            ->showMenuBar()
            ->required();
    }

    public static function render(string $content): string
    {
        return html_entity_decode($content);
    }
}

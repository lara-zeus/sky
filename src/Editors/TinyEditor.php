<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Textarea;
use LaraZeus\Sky\Classes\ContentEditor;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor as TinyEditorAlias;

class TinyEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(TinyEditorAlias::class)) {
            return TinyEditorAlias::make('content')
                ->label(__('Post Content'))
                ->showMenuBar()
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(TinyEditorAlias::class)) {
            return html_entity_decode($content);
        }

        return $content;
    }
}

<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\RichEditor as RichEditorAlias;
use Filament\Forms\Components\Textarea;
use LaraZeus\Sky\Classes\ContentEditor;

class RichEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(RichEditorAlias::class)) {
            return RichEditorAlias::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        return html_entity_decode($content);
    }
}

<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\MarkdownEditor as MarkdownEditorAlias;
use Filament\Forms\Components\Textarea;
use LaraZeus\Sky\Classes\ContentEditor;

class MarkdownEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(MarkdownEditorAlias::class)) {
            return MarkdownEditorAlias::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(MarkdownEditorAlias::class)) {
            return str($content)->markdown();
        }

        return $content;
    }
}

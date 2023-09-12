<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use LaraZeus\Sky\Classes\ContentEditor;

class MarkdownEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(RichEditor::class)) {
            return RichEditor::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(RichEditor::class)) {
            return str($content)->markdown();
        }

        return $content;
    }
}

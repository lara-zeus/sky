<?php

namespace LaraZeus\Sky\Classes;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Textarea;
use Spatie\FilamentMarkdownEditor\MarkdownEditor as MarkdownEditorAlias;

class MarkdownEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(MarkdownEditorAlias::class, false)) {
            return MarkdownEditorAlias::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(MarkdownEditorAlias::class, false)) {
            return str($content)->markdown();
        }

        return $content;
    }
}

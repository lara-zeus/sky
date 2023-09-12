<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Textarea;
use LaraZeus\Sky\Classes\ContentEditor;

class TipTapEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(\FilamentTiptapEditor\TiptapEditor::class)) {
            return \FilamentTiptapEditor\TiptapEditor::make('content')
                ->profile('default')
                // @phpstan-ignore-next-line
                ->output(\FilamentTiptapEditor\Enums\TiptapOutput::Html)
                ->extraInputAttributes(['style' => 'min-height: 24rem;'])
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(\FilamentTiptapEditor\TiptapEditor::class)) {
            // @phpstan-ignore-next-line
            return tiptap_converter()->asHTML($content);
        }

        return $content;
    }
}

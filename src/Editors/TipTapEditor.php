<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Textarea;
use FilamentTiptapEditor\Enums\TiptapOutput;
use LaraZeus\Sky\Classes\ContentEditor;

class TipTapEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(\FilamentTiptapEditor\TiptapEditor::class)) {
            return \FilamentTiptapEditor\TiptapEditor::make('content')
                ->profile('default')
                ->output(TiptapOutput::Html)
                ->extraInputAttributes(['style' => 'min-height: 24rem;'])
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(\FilamentTiptapEditor\TiptapEditor::class)) {
            return tiptap_converter()->asHTML($content);
        }

        return $content;
    }
}

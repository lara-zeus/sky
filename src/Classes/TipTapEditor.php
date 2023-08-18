<?php

namespace LaraZeus\Sky\Classes;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Textarea;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor as TipTapEditorAlias;

class TipTapEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(TipTapEditorAlias::class)) {
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
        if (class_exists(TipTapEditorAlias::class)) {
            return tiptap_converter()->asHTML($content);
        }

        return $content;
    }
}

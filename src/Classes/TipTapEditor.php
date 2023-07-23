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
        //todo
        /*if (class_exists(TipTapEditorAlias::class)) {
            return \FilamentTiptapEditor\TiptapEditor::make('content')
                ->profile('default')
                ->output(TiptapOutput::Html)
                ->required();
        }*/

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

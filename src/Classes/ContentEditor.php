<?php

namespace LaraZeus\Sky\Classes;

use Filament\Forms\Components\Component;

interface ContentEditor
{
    public static function component(): Component;

    public static function render(string $content): string;
}

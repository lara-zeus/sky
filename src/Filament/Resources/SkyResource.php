<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;

class SkyResource extends Resource
{
    use Translatable;

    public static function getTranslatableLocales(): array
    {
        return config('zeus-sky.translatable_Locales');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __(config('zeus-sky.navigation_group_label', 'Sky'));
    }
}

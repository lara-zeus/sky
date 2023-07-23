<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use LaraZeus\Sky\SkyPlugin;

class SkyResource extends Resource
{
    use Translatable;

    public static function getNavigationGroup(): ?string
    {
        return SkyPlugin::get()->getNavigationGroupLabel();
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::query()->count();
    }
}

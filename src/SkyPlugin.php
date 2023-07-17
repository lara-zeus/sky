<?php

namespace LaraZeus\Sky;

use Filament\Contracts\Plugin;
use Filament\Panel;
use LaraZeus\Sky\Filament\Resources\TagResource;

class SkyPlugin implements Plugin
{
    public function getId(): string
    {
        return 'zeus-sky';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources(array_merge(
                config('zeus-sky.enabled_resources'),
                [TagResource::class]
            ));
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

<?php

namespace LaraZeus\Sky;

use Filament\Contracts\Plugin;
use Filament\Panel;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;

class SkyPlugin implements Plugin
{
    use Configuration;

    public function getId(): string
    {
        return 'zeus-sky';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasPostResource()) {
            $panel->resources([PostResource::class]);
        }

        if ($this->hasPageResource()) {
            $panel->resources([PageResource::class]);
        }

        if ($this->hasFaqResource()) {
            $panel->resources([FaqResource::class]);
        }

        if ($this->hasLibraryResource()) {
            $panel->resources([LibraryResource::class]);
        }

        $panel->resources([TagResource::class]);
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): Plugin | \Filament\FilamentManager
    {
        return filament(app(static::class)->getId());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

<?php

namespace LaraZeus\Sky;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;

final class SkyPlugin implements Plugin
{
    use Configuration;
    use EvaluatesClosures;

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

        if ($this->hasTagResource()) {
            $panel->resources([TagResource::class]);
        }

        if ($this->hasNavigationResource()) {
            $panel->resources([NavigationResource::class]);
        }
    }

    public static function make(): static
    {
        return new self();
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament('zeus-sky');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

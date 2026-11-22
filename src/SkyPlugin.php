<?php

namespace LaraZeus\Sky;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\FilamentPluginTools\Concerns\CanDisableBadges;
use LaraZeus\FilamentPluginTools\Concerns\CanHideResources;
use LaraZeus\FilamentPluginTools\Concerns\HasEnums;
use LaraZeus\FilamentPluginTools\Concerns\HasModels;
use LaraZeus\FilamentPluginTools\Concerns\HasNavigationGroupLabel;
use LaraZeus\FilamentPluginTools\Concerns\HasRouteNamePrefix;
use LaraZeus\FilamentPluginTools\Concerns\HasUploads;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;

final class SkyPlugin implements Plugin
{
    use CanDisableBadges;
    use CanHideResources;
    use Configuration;
    use EvaluatesClosures;
    use HasEnums;
    use HasModels;
    use HasNavigationGroupLabel;
    use HasRouteNamePrefix;
    use HasUploads;

    protected Closure | string $navigationGroupLabel = 'Sky';

    public function getId(): string
    {
        return 'zeus-sky';
    }

    public function register(Panel $panel): void
    {
        if (! in_array(PostResource::class, $this->getHiddenResources())) {
            $panel->resources([PostResource::class]);
        }

        if (! in_array(PageResource::class, $this->getHiddenResources())) {
            $panel->resources([PageResource::class]);
        }

        if ($this->hasFaqResource() && ! in_array(FaqResource::class, $this->getHiddenResources())) {
            $panel->resources([FaqResource::class]);
        }

        if ($this->hasLibraryResource() && ! in_array(LibraryResource::class, $this->getHiddenResources())) {
            $panel->resources([LibraryResource::class]);
        }

        if (! in_array(TagResource::class, $this->getHiddenResources())) {
            $panel->resources([TagResource::class]);
        }

        if (! in_array(NavigationResource::class, $this->getHiddenResources())) {
            $panel->resources([NavigationResource::class]);
        }
    }

    public static function make(): static
    {
        return new self;
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

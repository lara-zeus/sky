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
        $postResource = config('zeus-sky.resource.post', PostResource::class);
        if (! in_array($postResource, $this->getHiddenResources(), true)) {
            $panel->resources([$postResource]);
        }

        $pageResource = config('zeus-sky.resource.page', PageResource::class);
        if (! in_array($pageResource, $this->getHiddenResources(), true)) {
            $panel->resources([$pageResource]);
        }

        $faqResource = config('zeus-sky.resource.faq', FaqResource::class);
        if (! in_array($faqResource, $this->getHiddenResources(), true)) {
            $panel->resources([$faqResource]);
        }

        $libraryResource = config('zeus-sky.resource.library', LibraryResource::class);
        if (! in_array($libraryResource, $this->getHiddenResources(), true)) {
            $panel->resources([$libraryResource]);
        }

        $navigationResource = config('zeus-sky.resource.navigation', NavigationResource::class);
        if (! in_array($navigationResource, $this->getHiddenResources(), true)) {
            $panel->resources([$navigationResource]);
        }

        $tagResource = config('zeus-sky.resource.tag', TagResource::class);
        if (! in_array($tagResource, $this->getHiddenResources(), true)) {
            $panel->resources([$tagResource]);
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

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
use LaraZeus\FilamentPluginTools\Concerns\HasResources;
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
    use HasResources;
    use HasRouteNamePrefix;
    use HasUploads;

    protected Closure | string $navigationGroupLabel = 'Sky';

    public function getId(): string
    {
        return 'zeus-sky';
    }

    public function register(Panel $panel): void
    {
        $defaultResources = [
            'Post' => PostResource::class,
            'Page' => PageResource::class,
            'Faq' => FaqResource::class,
            'Library' => LibraryResource::class,
            'Tag' => TagResource::class,
            'Navigation' => NavigationResource::class,
        ];

        $resources = [];

        foreach ($defaultResources as $key => $defaultResource) {
            $resource = self::getResource($key) ?? $defaultResource;

            if (! in_array($resource, $this->getHiddenResources(), true)) {
                $resources[] = $resource;
            }
        }

        if ($resources !== []) {
            $panel->resources($resources);
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

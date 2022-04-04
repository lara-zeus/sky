<?php

namespace LaraZeus\Sky;

use Filament\PluginServiceProvider;
use LaraZeus\Sky\Filament\Pages\Importer;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;
use Spatie\LaravelPackageTools\Package;

class SkyServiceProvider extends PluginServiceProvider
{
    public static string $name = 'zeus-sky';

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);
        $package
            ->hasConfigFile()
            ->hasMigrations(['create_posts_table'])
            ->hasRoute('web');
    }

    protected array $pages = [
        Importer::class,
    ];

    protected function getResources(): array
    {
        return [
            PostResource::class,
            TagResource::class,
        ];
    }
}

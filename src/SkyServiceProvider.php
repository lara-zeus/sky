<?php

namespace LaraZeus\Sky;

use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\Blade;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;
use Spatie\LaravelPackageTools\Package;

class SkyServiceProvider extends PluginServiceProvider
{
    public static string $name = 'zeus-sky';

    public function boot()
    {
        seo()
            ->site(config('app.name', 'Laravel'))
            ->title(config('zeus-sky.site_title'))
            ->description(config('zeus-sky.site_description'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="'.asset('favicon/favicon.ico').'">')
            ->rawTag('<meta name="theme-color" content="'.config('zeus-sky.site_color').'" />')
            ->withUrl()
            ->twitter();

        // let me have my fun 🤷🏽‍
        Blade::directive('zeus', function ($part = null) {
            return '<span class="text-secondary-700 group"><span class="font-semibold text-primary-600 group-hover:text-secondary-500 transition ease-in-out duration-300">Lara&nbsp;<span class="line-through italic text-secondary-500 group-hover:text-primary-600 transition ease-in-out duration-300">Z</span>eus</span></span>'
                .($part) ?? '<span class="text-base tracking-wide text-secondary-500 ml-4">{$part}</span>';
        });

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);
        $package
            ->hasConfigFile()
            ->hasMigrations(['create_posts_table'])
            ->hasRoute('web');
    }

    protected function getResources(): array
    {
        return [
            PostResource::class,
            TagResource::class,
        ];
    }
}

<?php

namespace LaraZeus\Sky;

use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use LaraZeus\Sky\Filament\Resources\PageResource;
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
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus-sky.site_color') . '" />')
            ->withUrl()
            ->twitter();

        View::share('theme', 'zeus-sky::themes.' . config('zeus-sky.theme'));

        App::singleton('theme', function () {
            return 'zeus-sky::themes.' . config('zeus-sky.theme');
        });

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);
        $package
            ->hasConfigFile()
            ->hasMigrations(['create_posts_table'])
            ->hasRoute('web')
            ->hasTranslations();
    }

    protected function getResources(): array
    {
        return [
            PostResource::class,
            PageResource::class,
            TagResource::class,
        ];
    }
}

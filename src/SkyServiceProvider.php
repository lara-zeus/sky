<?php

namespace LaraZeus\Sky;

use Filament\Facades\Filament;
use LaraZeus\Core\CoreServiceProvider;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SkyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'zeus-sky';

    public function packageBooted(): void
    {
        CoreServiceProvider::setThemePath('sky');

        Filament::serving(function () {
            $this->bootFilamentNavigation();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasMigrations($this->getMigrations())
            ->hasTranslations()
            ->hasCommands($this->getCommands())
            ->hasViews('zeus')
            ->hasRoute('web');
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            migrateCommand::class,
            PublishCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_posts_table',
            'create_faqs_table',
            'modify_posts_columns',
            'create_library_table',
        ];
    }

    private function bootFilamentNavigation(): void
    {
        if (!app('filament')->hasPlugin('zeus-sky')) {
            return;
        }

        NavigationResource::navigationGroup(SkyPlugin::get()->getNavigationGroupLabel());
        NavigationResource::navigationSort(999);
        NavigationResource::navigationIcon('heroicon-o-queue-list');
        NavigationResource::navigationLabel(__('Navigations'));
        NavigationResource::pluralLabel(__('Navigations'));
        NavigationResource::label(__('Navigation'));
    }
}

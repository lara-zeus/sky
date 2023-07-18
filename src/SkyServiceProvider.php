<?php

namespace LaraZeus\Sky;

use Filament\Facades\Filament;
use LaraZeus\Core\CoreServiceProvider;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SkyServiceProvider extends PackageServiceProvider
{
    public function packageBooted(): void
    {
        CoreServiceProvider::setThemePath('sky');

        Filament::serving(function () {
            // todo
            //$this->bootFilamentNavigation();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('zeus-sky')
            ->hasMigrations($this->getMigrations())
            ->hasCommands($this->getCommands())
            ->hasViews('zeus')
            ->hasConfigFile()
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

    /*private function bootFilamentNavigation(): void
    {
        NavigationResource::navigationGroup(__(config('zeus-sky.navigation_group_label', 'Sky')));
        NavigationResource::navigationSort(99);

        NavigationResource::navigationLabel(__('Navigations'));
        NavigationResource::pluralLabel(__('Navigations'));
        NavigationResource::label(__('Navigation'));

        NavigationResource::navigationIcon('iconpark-treelist-o');

        FilamentNavigation::addItemType(__('Post link'), [
            Select::make('post_id')
                ->label(__('Select Post'))
                ->searchable()
                ->options(function () {
                    return config('zeus-sky.models.post')::published()->pluck('title', 'id');
                }),
        ]);

        FilamentNavigation::addItemType(__('Page link'), [
            Select::make('page_id')
                ->label(__('Select Page'))
                ->searchable()
                ->options(function () {
                    return config('zeus-sky.models.post')::page()->pluck('title', 'id');
                }),
        ]);
    }*/
}

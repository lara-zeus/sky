<?php

namespace LaraZeus\Sky;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use LaraZeus\Sky\Filament\Resources\TagResource;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;

class SkyServiceProvider extends PluginServiceProvider
{
    public static string $name = 'zeus-sky';

    protected function getResources(): array
    {
        // TagResource should not be disabled.
        return array_merge(
            config('zeus-sky.enabled_resources'),
            [TagResource::class]
        );
    }

    public function bootingPackage(): void
    {
        View::share('theme', 'zeus-sky::themes.' . config('zeus-sky.theme', 'zeus'));
        App::singleton('theme', function () {
            return 'zeus-sky::themes.' . config('zeus-sky.theme', 'zeus');
        });

        Filament::serving(function () {
            $this->bootFilamentNavigation();
        });
    }

    protected function getCommands(): array
    {
        return [
            migrateCommand::class,
            PublishCommand::class,
        ];
    }

    public function packageConfiguring(Package $package): void
    {
        $package
            ->hasMigrations(['create_posts_table', 'create_faqs_table', 'modify_posts_columns','add_indices_to_posts'])
            ->hasRoute('web');
    }

    private function bootFilamentNavigation(): void
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
    }
}

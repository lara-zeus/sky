<?php

namespace LaraZeus\Sky;

use Filament\Forms\Components\Select;
use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use LaraZeus\Sky\Filament\Resources\TagResource;
use LaraZeus\Sky\Models\Post;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;

class SkyServiceProvider extends PluginServiceProvider
{
    public static string $name = 'zeus-sky';

    public function boot()
    {
        View::share('theme', 'zeus-sky::themes.' . config('zeus-sky.theme', 'zeus'));

        App::singleton('theme', function () {
            return 'zeus-sky::themes.' . config('zeus-sky.theme', 'zeus');
        });

        $this->bootFilamentNavigation();

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);
        $package
            ->hasConfigFile()
            ->hasMigrations(['create_posts_table', 'create_faqs_table', 'modify_posts_columns'])
            ->hasRoute('web')
            ->hasCommands([
                migrateCommand::class,
                PublishCommand::class,
            ])
            ->hasTranslations();
    }

    protected function getResources(): array
    {
        // TagResource should not be disabled.
        return array_merge(
            config('zeus-sky.enabled_resources'),
            [TagResource::class]
        );
    }

    private function bootFilamentNavigation(): void
    {
        NavigationResource::navigationGroup(__(config('zeus-sky.navigation_group_label', 'Sky')));
        NavigationResource::navigationSort(99);

        NavigationResource::navigationLabel(__('Navigations'));
        NavigationResource::pluralLabel(__('Navigations'));
        NavigationResource::label(__('Navigation'));

        NavigationResource::navigationIcon('iconpark-treelist-o');

        FilamentNavigation::addItemType('Post link', [
            Select::make('post_id')
                ->label(__('Select Post'))
                ->searchable()
                ->options(function () {
                    return Post::published()->pluck('title', 'id');
                })
        ]);

        FilamentNavigation::addItemType('Page link', [
            Select::make('page_id')
                ->label(__('Select Page'))
                ->searchable()
                ->options(function () {
                    return Post::page()->pluck('title', 'id');
                })
        ]);
    }
}

<?php

namespace LaraZeus\Sky;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use LaraZeus\Core\CoreServiceProvider;
use LaraZeus\Sky\Console\InstallCommand;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use LaraZeus\Sky\Console\ZeusEditorCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SkyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'zeus-sky';

    public function packageBooted(): void
    {
        CoreServiceProvider::setThemePath('sky');
        $this->bootFilamentNavigation();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasMigrations($this->getMigrations())
            ->hasTranslations()
            ->hasConfigFile()
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
            InstallCommand::class,
            ZeusEditorCommand::class,
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
            'create_navigations_table',
        ];
    }

    private function bootFilamentNavigation(): void
    {
        Filament::serving(function () {
            if (! defined('__PHPSTAN_RUNNING__') &&
                ! app('filament')->hasPlugin('zeus-sky')
            ) {
                return;
            }

            SkyPlugin::get()
                ->itemType(
                    __('Post link'),
                    [
                        Select::make('post_id')
                            ->label(__('Select Post'))
                            ->searchable()
                            ->options(function () {
                                return SkyPlugin::get()->getModel('Post')::published()->pluck('title', 'id');
                            }),
                    ],
                    'post_link'
                )
                ->itemType(
                    __('Page link'),
                    [
                        Select::make('page_id')
                            ->label(__('Select Page'))
                            ->searchable()
                            ->options(function () {
                                return SkyPlugin::get()->getModel('Post')::page()->pluck('title', 'id');
                            }),
                    ],
                    'page_link'
                )
                ->itemType(
                    __('Library link'),
                    [
                        Select::make('library_id')
                            ->label(__('Select Library'))
                            ->searchable()
                            ->options(function () {
                                return SkyPlugin::get()->getModel('Tag')::getWithType('library')->pluck('name', 'id');
                            }),
                    ],
                    'library_link'
                );
        });
    }
}

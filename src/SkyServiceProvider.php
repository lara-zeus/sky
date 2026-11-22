<?php

namespace LaraZeus\Sky;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use LaraZeus\Core\CoreServiceProvider;
use LaraZeus\Sky\Console\InstallCommand;
use LaraZeus\Sky\Console\migrateCommand;
use LaraZeus\Sky\Console\PublishCommand;
use LaraZeus\Sky\Console\ZeusEditorCommand;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
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
            ->hasViews('zeus');

        if (! config('zeus-sky.headless')) {
            $package->hasRoute('web');
        }
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

            /** @var class-string<Post> $postModel */
            $postModel = SkyPlugin::get()->getModel('Post');
            /** @var class-string<Tag> $tagModel */
            $tagModel = SkyPlugin::get()->getModel('Tag');

            SkyPlugin::get()
                ->itemType(
                    __('zeus-sky::cms.post.link'),
                    [
                        Select::make('post_id')
                            ->label(__('zeus-sky::cms.post.select_post'))
                            ->searchable()
                            ->options(function () use ($postModel) {
                                return $postModel::published()->pluck('title', 'id');
                            }),
                    ],
                    'post_link'
                )
                ->itemType(
                    __('zeus-sky::cms.page.link'),
                    [
                        Select::make('page_id')
                            ->label(__('zeus-sky::cms.page.select_page'))
                            ->searchable()
                            ->options(
                                $postModel::query()
                                    ->page()
                                    ->whereDate('published_at', '<=', now())
                                    ->pluck('title', 'id')
                            ),
                    ],
                    'page_link'
                )
                ->itemType(
                    __('zeus-sky::cms.library.library_link'),
                    [
                        Select::make('library_id')
                            ->label(__('zeus-sky::cms.library.select_library'))
                            ->searchable()
                            ->options(
                                $tagModel::getWithType('library')->pluck('name', 'id')
                            ),
                    ],
                    'library_link'
                );
        });
    }
}

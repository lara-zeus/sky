<?php

use Filament\Facades\Filament;
use Filament\Panel;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Sky\Tests\Fixtures\CustomPostResource;

function registerSkyPanel(SkyPlugin $plugin): Panel
{
    $panel = Panel::make()
        ->id('admin')
        ->default()
        ->plugin($plugin);

    Filament::registerPanel($panel);
    Filament::setCurrentPanel($panel);

    return $panel;
}

it('registers all default resources', function (): void {
    $panel = registerSkyPanel(SkyPlugin::make());

    expect($panel->getResources())->toBe([
        PostResource::class,
        PageResource::class,
        FaqResource::class,
        LibraryResource::class,
        TagResource::class,
        NavigationResource::class,
    ]);
});

it('can disable faq and library resources via configuration methods', function (): void {
    $panel = registerSkyPanel(
        SkyPlugin::make()
            ->faqResource(false)
            ->libraryResource(false)
    );

    expect($panel->getResources())
        ->not->toContain(FaqResource::class)
        ->not->toContain(LibraryResource::class)
        ->toContain(PostResource::class)
        ->toContain(PageResource::class)
        ->toContain(TagResource::class)
        ->toContain(NavigationResource::class);
});

it('can swap a resource via the plugin resources method', function (): void {
    $panel = registerSkyPanel(
        SkyPlugin::make()->resources([
            'Post' => CustomPostResource::class,
        ])
    );

    expect($panel->getResources())
        ->toContain(CustomPostResource::class)
        ->not->toContain(PostResource::class);
});

it('can swap a resource via config', function (): void {
    config()->set('zeus-sky.resources.Post', CustomPostResource::class);

    $panel = registerSkyPanel(SkyPlugin::make());

    expect($panel->getResources())
        ->toContain(CustomPostResource::class)
        ->not->toContain(PostResource::class);
});

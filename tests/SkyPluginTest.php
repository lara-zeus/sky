<?php

use Filament\Panel;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\SkyPlugin;

it('registers the addon resources by default', function () {
    $panel = Panel::make();

    SkyPlugin::make()->register($panel);

    expect($panel->getResources())
        ->toContain(FaqResource::class)
        ->toContain(LibraryResource::class);
});

it('does not register a disabled addon resource', function (string $method, string $disabledResource, string $enabledResource) {
    $panel = Panel::make();

    $plugin = SkyPlugin::make();
    $plugin->{$method}(false);
    $plugin->register($panel);

    expect($panel->getResources())->not->toContain($disabledResource);
    expect($panel->getResources())->toContain($enabledResource);
})->with([
    'FAQ' => ['faqResource', FaqResource::class, LibraryResource::class],
    'library' => ['libraryResource', LibraryResource::class, FaqResource::class],
]);

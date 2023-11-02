<?php

namespace LaraZeus\Sky\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Sky\Filament\Resources\NavigationResource;

class CreateNavigation extends CreateRecord
{
    use NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}

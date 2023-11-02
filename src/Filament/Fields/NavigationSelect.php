<?php

namespace LaraZeus\Sky\Filament\Fields;

use Filament\Forms\Components\Select;
use LaraZeus\Sky\SkyPlugin;

class NavigationSelect extends Select
{
    protected string $optionValueProperty = 'id';

    protected function setUp(): void
    {
        parent::setUp();

        $this->options(function (NavigationSelect $component) {
            return SkyPlugin::get()->getModel('Navigation')::pluck('name', $component->getOptionValueProperty());
        });
    }

    public function getOptionValueProperty(): string
    {
        return $this->optionValueProperty;
    }
}

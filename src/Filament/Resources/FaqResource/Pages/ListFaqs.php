<?php

namespace LaraZeus\Sky\Filament\Resources\FaqResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\Sky\Filament\Resources\FaqResource;

class ListFaqs extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FaqResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-external-link')
                ->label(__('Open'))
                ->url(fn (): string => route('faq'))
                ->openUrlInNewTab(),
            LocaleSwitcher::make(),
        ];
    }
}

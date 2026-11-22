<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\CreateNavigation;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\EditNavigation;
use LaraZeus\Sky\Filament\Resources\NavigationResource\Pages\ListNavigations;
use LaraZeus\Sky\SkyPlugin;

class NavigationResource extends SkyResource
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 99;

    protected static bool $showTimestamps = true;

    public static function disableTimestamps(bool $condition = true): void
    {
        static::$showTimestamps = ! $condition;
    }

    public static function form(Schema $schema): Schema
    {
        /** @var view-string $navigationBuilderView */
        $navigationBuilderView = 'zeus::filament.navigation-builder';
        /** @var view-string $cardDividerView */
        $cardDividerView = 'zeus::filament.card-divider';

        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('zeus-sky::filament-navigation.attributes.name'))
                            ->reactive()
                            ->debounce()
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (! $state) {
                                    return;
                                }

                                $set('handle', Str::slug($state));
                            })
                            ->required(),
                        ViewField::make('items')
                            ->label(__('zeus-sky::filament-navigation.attributes.items'))
                            ->default([])
                            ->view($navigationBuilderView),
                    ])
                    ->columnSpan([
                        'default' => 12,
                        'lg' => 8,
                    ]),
                Section::make()
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('handle')
                            ->label(__('zeus-sky::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(),
                        View::make($cardDividerView)
                            ->visible(static::$showTimestamps),
                        TextEntry::make('created_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.created_at'))
                            ->visible(static::$showTimestamps),
                        TextEntry::make('updated_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.updated_at'))
                            ->visible(static::$showTimestamps),
                    ])
                    ->columnSpan([
                        'default' => 12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
    }

    public static function getLabel(): string
    {
        return __('zeus-sky::filament-navigation.label');
    }

    public static function getPluralLabel(): string
    {
        return __('zeus-sky::filament-navigation.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('zeus-sky::filament-navigation.navigation_label');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('zeus-sky::filament-navigation.attributes.name'))
                    ->searchable(),
                TextColumn::make('handle')
                    ->label(__('zeus-sky::filament-navigation.attributes.handle'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('zeus-sky::filament-navigation.attributes.created_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('zeus-sky::filament-navigation.attributes.updated_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->icon(null),
                DeleteAction::make()->icon(null),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNavigations::route('/'),
            'create' => CreateNavigation::route('/create'),
            'edit' => EditNavigation::route('/{record}'),
        ];
    }

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Navigation');
    }
}

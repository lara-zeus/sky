<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use LaraZeus\Sky\Models\Navigation;
use LaraZeus\Sky\SkyPlugin;

class NavigationResource extends SkyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 99;

    protected static bool $showTimestamps = true;

    public static function disableTimestamps(bool $condition = true): void
    {
        static::$showTimestamps = ! $condition;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
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
                        ->view('zeus::filament.navigation-builder'),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 8,
                    ]),
                Group::make([
                    Section::make('')->schema([
                        TextInput::make('handle')
                            ->label(__('zeus-sky::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(column: 'handle', ignoreRecord: true),
                        View::make('zeus::filament.card-divider')
                            ->visible(static::$showTimestamps),
                        Placeholder::make('created_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.created_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn (?Navigation $record) => $record ? $record->created_at->translatedFormat(Table::$defaultDateTimeDisplayFormat) : new HtmlString('&mdash;')),
                        Placeholder::make('updated_at')
                            ->label(__('zeus-sky::filament-navigation.attributes.updated_at'))
                            ->visible(static::$showTimestamps)
                            ->content(fn (?Navigation $record) => $record ? $record->updated_at->translatedFormat(Table::$defaultDateTimeDisplayFormat) : new HtmlString('&mdash;')),
                    ]),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
    }

    public static function getLabel(): string
    {
        return __('Navigation');
    }

    public static function getPluralLabel(): string
    {
        return __('Navigations');
    }

    public static function getNavigationLabel(): string
    {
        return __('Navigations');
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
            ->actions([
                EditAction::make()
                    ->icon(null),
                DeleteAction::make()
                    ->icon(null),
            ])
            ->filters([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => NavigationResource\Pages\ListNavigations::route('/'),
            'create' => NavigationResource\Pages\CreateNavigation::route('/create'),
            'edit' => NavigationResource\Pages\EditNavigation::route('/{record}'),
        ];
    }

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Navigation');
    }
}

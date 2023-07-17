<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages;

class TagResource extends SkyResource
{
    public static function getModel(): string
    {
        return config('zeus-sky.models.tag');
    }

    protected static ?string $navigationIcon = 'iconpark-tag-o';

    protected static ?string $navigationGroup = 'Sky';

    protected static function shouldRegisterNavigation(): bool
    {
        return in_array(self::class, config('zeus-sky.enabled_resources'));
    }

    protected static function getNavigationBadge(): ?string
    {
        return (string) config('zeus-sky.models.tag')::query()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('Tag.Name'))
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->unique(ignorable: fn (?Model $record): ?Model => $record)
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options(config('zeus-sky.tags_types')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->toggleable()->searchable()->sortable(),
                TextColumn::make('type')->toggleable()->searchable()->sortable(),
                TextColumn::make('slug')->toggleable()->searchable()->sortable(),
                TextColumn::make('items_count')
                    ->toggleable()
                    ->view('zeus::filament.columns.tag-counts'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(config('zeus-sky.tags_types'))
                    ->label(__('type')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Tag');
    }

    public static function getPluralLabel(): string
    {
        return __('Tags');
    }

    protected static function getNavigationLabel(): string
    {
        return __('Tags');
    }
}

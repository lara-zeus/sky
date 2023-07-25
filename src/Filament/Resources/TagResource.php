<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages;
use LaraZeus\Sky\SkyPlugin;

class TagResource extends SkyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getModel(): string
    {
        return SkyPlugin::get()->getFaqModel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('Tag.Name'))
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->unique(ignorable: fn (?Model $record): ?Model => $record)
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options(SkyPlugin::get()->getTagTypes()),
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
                    ->options(SkyPlugin::get()->getTagTypes())
                    ->label(__('type')),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit'),
                    DeleteAction::make('delete'),
                ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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

    public static function getNavigationLabel(): string
    {
        return __('Tags');
    }
}

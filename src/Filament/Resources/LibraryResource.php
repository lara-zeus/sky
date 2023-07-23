<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;
use LaraZeus\Sky\Models\Library;

class LibraryResource extends SkyResource
{
    protected static ?string $slug = 'library';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function getModel(): string
    {
        return config('zeus-sky.models.library') ?? Library::class;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Library Title'))
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state, $context) {
                        if ($context === 'edit') {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->unique(ignorable: fn (?Library $record): ?Library => $record)
                    ->required()
                    ->maxLength(255)
                    ->label(__('Library Slug')),

                Textarea::make('description')
                    ->maxLength(255)
                    ->label(__('Library Description'))
                    ->columnSpan(2),

                SpatieTagsInput::make('category')
                    ->type('library')
                    ->label(__('Library Categories')),

                Select::make('type')
                    ->label(__('Library Type'))
                    ->visible(config('zeus-sky.library_types') !== null)
                    ->options(config('zeus-sky.library_types', [])),

                Section::make(__('Library File'))
                    ->schema([
                        Radio::make('upload_or_url')
                            ->label('')
                            ->live()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (Set $set, Get $get) {
                                $setVal = ($get('file_path') === null) ? 'upload' : 'url';
                                $set('upload_or_url', $setVal);
                            })
                            ->default('upload')
                            ->options([
                                'upload' => __('upload'),
                                'url' => __('url'),
                            ])
                            ->inline(),

                        SpatieMediaLibraryFileUpload::make('file_path_upload')
                            ->collection('library')
                            ->multiple()
                            ->reorderable()
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'upload')
                            ->label(''),

                        TextInput::make('file_path')
                            ->label(__('file url'))
                            ->visible(fn (Get $get) => $get('upload_or_url') === 'url')
                            ->url(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('Library Title'))->searchable()->sortable()->toggleable(),
                TextColumn::make('slug')->label(__('Library Slug'))->searchable()->sortable()->toggleable(),

                TextColumn::make('type')
                    ->label(__('Library Type'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => str($state)->title())
                    ->color('primary')
                    ->icon(fn (string $state) => match ($state) {
                        'IMAGE' => 'heroicon-o-photo',
                        'FILE' => 'heroicon-o-document',
                        'VIDEO' => 'heroicon-o-film',
                        default => 'heroicon-o-document-magnifying-glass',
                    })
                    ->toggleable(),

                SpatieTagsColumn::make('tags')
                    ->label(__('Library Tags'))
                    ->toggleable()
                    ->type('library'),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')->label(__('Edit')),
                    Action::make('Open')
                        ->color('warning')
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->label(__('Open'))
                        ->url(fn (Library $record): string => route('library.item', ['slug' => $record->slug]))
                        ->openUrlInNewTab(),
                    DeleteAction::make('delete')
                        ->label(__('Delete')),
                ]),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(config('zeus-sky.library_types'))
                    ->label(__('type')),
                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibrary::route('/'),
            'create' => Pages\CreateLibrary::route('/create'),
            'edit' => Pages\EditLibrary::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Library');
    }

    public static function getPluralLabel(): string
    {
        return __('Libraries');
    }

    public static function getNavigationLabel(): string
    {
        return __('Libraries');
    }
}

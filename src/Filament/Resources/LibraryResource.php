<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\LibraryResource\Pages;
use LaraZeus\Sky\Models\Library;

class LibraryResource extends SkyResource
{
    public static function getModel(): string
    {
        return config('zeus-sky.models.library') ?? Library::class;
    }

    protected static ?string $slug = 'library';

    protected static ?string $navigationIcon = 'iconpark-folderopen';

    protected static function getNavigationBadge(): ?string
    {
        return (string) config('zeus-sky.models.library')::query()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Library Title'))
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state, $context) {
                        if ($context === 'edit') {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->unique(ignorable: fn (?Model $record): ?Model => $record)
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
                    ->options(config('zeus-sky.library_types', null)),

                Section::make(__('Library File'))
                    ->schema([
                        Radio::make('upload_or_url')
                            ->label('')
                            ->reactive()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (Closure $set, Closure $get) {
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
                            ->visible(fn (Closure $get) => $get('upload_or_url') === 'upload')
                            ->label(''),

                        TextInput::make('file_path')
                            ->label(__('file url'))
                            ->visible(fn (Closure $get) => $get('upload_or_url') === 'url')
                            ->url(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('Library Title')),
                TextColumn::make('slug')->label(__('Library Slug')),
                TextColumn::make('type')->label(__('Library Type')),

                SpatieTagsColumn::make('tags')
                    ->label(__('Library Tags'))
                    ->type('library'),
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

    protected static function getNavigationLabel(): string
    {
        return __('Libraries');
    }
}

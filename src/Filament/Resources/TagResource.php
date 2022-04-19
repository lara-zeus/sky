<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\TagResource\Pages;
use LaraZeus\Sky\Models\Tag;

class TagResource extends Resource
{
    use Translatable;

    protected static ?string $model = Tag::class;
    protected static ?string $navigationIcon = 'iconpark-tag-o';
    protected static ?string $navigationGroup = 'Sky';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255)->label(__('Tag.Name'))->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')->required()->maxLength(255),
                Select::make('type')
                    ->options([
                        'tag'      => 'Tag',
                        'category' => 'Category',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('slug'),
                TextColumn::make('posts_count')->counts('posts'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit'   => Pages\EditTag::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return config('zeus-sky.translatable_Locales');
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

    protected static function getNavigationGroup(): ?string
    {
        return __('Sky');
    }
}

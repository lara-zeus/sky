<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages;
use LaraZeus\Sky\SkyPlugin;

class FaqResource extends SkyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?int $navigationSort = 3;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Faq');
    }

    public static function getLabel(): string
    {
        return __('FAQ');
    }

    public static function getPluralLabel(): string
    {
        return __('frequently asked questions');
    }

    public static function getNavigationLabel(): string
    {
        return __('FAQs');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Library File'))
                    ->columns(2)
                    ->schema([
                        Textarea::make('question')
                            ->label(__('Question'))
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan(2),

                        RichEditor::make('answer')
                            ->label(__('Answer'))
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan(2),

                        SpatieTagsInput::make('category')
                            ->type('faq')
                            ->label(__('FAQ Categories')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->searchable(),

                SpatieTagsColumn::make('tags')
                    ->label(__('FAQ Categories'))
                    ->toggleable()
                    ->type('faq'),
            ])
            ->filters([
                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ])
            ->actions(static::getActions());
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            DeleteAction::make('delete')
                ->label(__('Delete')),
        ];

        if (class_exists(\LaraZeus\Helen\HelenServiceProvider::class)) {
            //@phpstan-ignore-next-line
            $action[] = \LaraZeus\Helen\Actions\ShortUrlAction::make('get-link')
                ->distUrl(fn (): string => route('faq'));
        }

        return [ActionGroup::make($action)];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}

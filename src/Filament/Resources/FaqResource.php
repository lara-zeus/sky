<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\RichEditor;
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
use LaraZeus\Sky\Models\Faq;

class FaqResource extends SkyResource
{
    protected static ?string $navigationIcon = 'iconpark-folderwithdrawal-o';

    public static function getModel(): string
    {
        return config('zeus-sky.models.faq') ?? Faq::class;
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
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')->label(__('Edit')),
                    DeleteAction::make('delete')
                        ->label(__('Delete')),
                ]),
            ]);
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

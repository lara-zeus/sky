<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages;
use LaraZeus\Sky\Models\Faq;

class FaqResource extends SkyResource
{
    public static function getModel(): string
    {
        return config('zeus-sky.models.faq') ?? Faq::class;
    }

    protected static ?string $navigationIcon = 'iconpark-folderwithdrawal-o';

    protected static function getNavigationBadge(): ?string
    {
        return (string) Faq::query()->count();
    }

    public static function getLabel(): string
    {
        return __('FAQ');
    }

    public static function getPluralLabel(): string
    {
        return __('frequently asked questions');
    }

    protected static function getNavigationLabel(): string
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->searchable(),
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

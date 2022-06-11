<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use LaraZeus\Sky\Filament\Resources\FaqResource\Pages;
use LaraZeus\Sky\Models\Faq;

class FaqResource extends Resource
{
    use Translatable;

    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'iconpark-folderwithdrawal-o';

    protected static function shouldRegisterNavigation(): bool
    {
        return config('zeus-sky.enableFaq');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Sky');
    }

    public static function getLabel(): string
    {
        return __('سؤال');
    }

    public static function getPluralLabel(): string
    {
        return __('الأسئلة الشائعة');
    }

    protected static function getNavigationLabel(): string
    {
        return __('الأسئلة الشائعة');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('question')->label(__('السؤال'))->required()->maxLength(65535)->columnSpan(2),
                RichEditor::make('answer')->label(__('الإجابة'))->required()->maxLength(65535)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question'),
            ])
            ->filters([
                //
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

    public static function getTranslatableLocales(): array
    {
        return config('zeus-sky.translatable_Locales');
    }
}

<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages;
use LaraZeus\Sky\Models\Post;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\DateTimePicker;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Sky';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TinyEditor::make('content'),
                    ]),

                Section::make('Post Options')
                    ->description('More option')
                    ->schema([
                        Textarea::make('description')->maxLength(255),
                        TextInput::make('slug'),
                        SpatieTagsInput::make('tags')->type('tag'),
                        SpatieTagsInput::make('category')->type('category'),
                        TextInput::make('user_id')->required(),
                        TextInput::make('parent_id'),
                        TextInput::make('ordering')->integer(),
                        TextInput::make('status'),
                        TextInput::make('password'),
                        SpatieMediaLibraryFileUpload::make('featured_image')->collection('posts'),
                        //FileUpload::make('featured_image'),
                        DateTimePicker::make('published_at'),
                        DateTimePicker::make('sticky_until'),
                        Hidden::make('post_type')->default('page'),
                    ])
                    ->columnSpan(1)
                    ->collapsible(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                ViewColumn::make('titleCard')->label('Title')->sortable(['title'])->view('zeus-sky::columns.post-title'),

                //TextColumn::make('user.name'),
                //TextColumn::make('parent_id'),
                //TextColumn::make('published_at')->dateTime(),
                TextColumn::make('post_type'),
                //TextColumn::make('updated_at')->dateTime(),
                //TextColumn::make('deleted_at')->dateTime(),
                //TextColumn::make('tags_count')->counts('tag'),
                SpatieTagsColumn::make('tags')->type('tag'),
                SpatieTagsColumn::make('category')->label('category')->type('category'),
            ])
            ->defaultSort('id','desc')
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

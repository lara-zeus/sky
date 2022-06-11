<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\PostStatus;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'iconpark-docdetail-o';

    public static function getTranslatableLocales(): array
    {
        return config('zeus-sky.translatable_Locales');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Card::make()->schema([
                        TextInput::make('title')
                            ->label(__('Post Title'))
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TinyEditor::make('content')->label(__('Post Content'))->showMenuBar()->required(),
                    ]),
                ])->columnSpan(3),

                Grid::make()->schema([
                    Section::make(__('SEO'))
                        ->description(__('SEO Settings'))
                        ->schema([
                            Hidden::make('user_id')->default(auth()->user()->id)->required(),
                            Hidden::make('post_type')->default('post')->required(),
                            Textarea::make('description')
                                ->maxLength(255)
                                ->label(__('Description'))
                                ->hint(__('Write an excerpt for your post')),
                            TextInput::make('slug')->required()->maxLength(255)->label(__('Post Slug')),
                        ])
                        ->collapsible(),

                    Section::make(__('Tags and Categories'))
                        ->description(__('Tags and Categories Options'))
                        ->schema([
                            SpatieTagsInput::make('tags')->type('tag')->label(__('Tags')),
                            SpatieTagsInput::make('category')->type('category')->label(__('Categories')),
                        ])
                        ->collapsible(),

                    Section::make(__('visibility'))
                        ->description(__('Visibility Options'))
                        ->schema([
                            Select::make('status')
                                ->label(__('status'))
                                ->default('publish')
                                ->required()
                                ->reactive()
                                ->options(PostStatus::pluck('label', 'name')),
                            TextInput::make('password')->label(__('Password'))->reactive()
                                ->visible(fn (Closure $get): bool => $get('status') === 'private'),
                            DateTimePicker::make('published_at')->label(__('published at'))->default(now()),
                            DateTimePicker::make('sticky_until')->label(__('Sticky Until')),
                        ])
                        ->collapsible(),

                    Section::make(__('Featured Image'))
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('featured_image')->collection('posts')->label(''),
                        ])
                        ->collapsible(),
                ])->columnSpan(1),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->view('zeus-sky::filament.columns.post-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->view('zeus-sky::filament.columns.status-desc')
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A')),

                SpatieTagsColumn::make('tags')->label(__('Post Tags'))->type('tag'),
                SpatieTagsColumn::make('category')->label(__('Post Category'))->type('category'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                MultiSelectFilter::make('status')->options(PostStatus::pluck('label', 'name')),

                Filter::make('password')->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),

                Filter::make('sticky')->label(__('Still Sticky'))
                    ->query(fn (Builder $query): Builder => $query->sticky()),

                Filter::make('not_sticky')->label(__('Not Sticky'))
                    ->query(fn (Builder $query): Builder => $query
                        ->whereDate('sticky_until', '<=', now())
                        ->orWhereNull('sticky_until')
                    ),

                Filter::make('sticky_only')->label(__('Sticky Only'))
                    ->query(fn (Builder $query): Builder => $query
                        ->wherePostType('post')
                        ->whereNotNull('sticky_until')
                    ),

                MultiSelectFilter::make('tags')->relationship('tags', 'name')->label(__('Tags')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Post');
    }

    public static function getPluralLabel(): string
    {
        return __('Posts');
    }

    protected static function getNavigationLabel(): string
    {
        return __('Posts');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Sky');
    }
}

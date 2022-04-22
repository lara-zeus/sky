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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\PostStatus;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $slug = 'pages';
    protected static ?string $navigationIcon = 'iconpark-folder-o';

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
                            Hidden::make('post_type')->default('page')->required(),
                            Textarea::make('description')
                                ->maxLength(255)
                                ->label(__('Description'))
                                ->hint(__('Write an excerpt for your post')),
                            TextInput::make('slug')->required()->maxLength(255)->label(__('Post Slug')),
                            Select::make('parent_id')->options(Post::wherePostType('page')->pluck('title', 'id'))->label(__('Parent Page'))->integer(),
                            TextInput::make('ordering')->integer()->label(__('Page Order'))->default(1),
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
                        ])
                        ->collapsible(),

                    Section::make(__('Featured Image'))
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('featured_image')->collection('pages')->label(''),
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
                    ->view('zeus-sky::filament.columns.page-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->view('zeus-sky::filament.columns.status-desc')
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                MultiSelectFilter::make('status')->options(PostStatus::pluck('label', 'name')),

                Filter::make('password')->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),
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
        return __('Page');
    }

    public static function getPluralLabel(): string
    {
        return __('Pages');
    }

    protected static function getNavigationLabel(): string
    {
        return __('Pages');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Sky');
    }
}

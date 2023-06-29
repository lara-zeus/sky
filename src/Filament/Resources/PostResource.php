<?php

namespace LaraZeus\Sky\Filament\Resources;

use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages;
use LaraZeus\Sky\Models\Post;

class PostResource extends SkyResource
{
    public static function getModel(): string
    {
        return config('zeus-sky.models.post');
    }

    protected static ?string $navigationIcon = 'iconpark-docdetail-o';

    protected static function getNavigationBadge(): ?string
    {
        return (string) config('zeus-sky.models.post')::query()->posts()->count();
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
                            ->afterStateUpdated(function (Closure $set, $state, $context) {
                                if ($context === 'edit') {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        config('zeus-sky.editor')::component(),
                    ]),
                ])->columnSpan(3),

                Grid::make()->schema([
                    Section::make(__('SEO'))
                        ->description(__('SEO Settings'))
                        ->schema([
                            Hidden::make('user_id')
                                ->default(auth()->user()->id)
                                ->required(),

                            Hidden::make('post_type')
                                ->default('post')
                                ->required(),

                            Textarea::make('description')
                                ->maxLength(255)
                                ->label(__('Description'))
                                ->hint(__('Write an excerpt for your post')),

                            TextInput::make('slug')
                                ->unique(ignorable: fn (?Post $record): ?Post => $record)
                                ->required()
                                ->maxLength(255)
                                ->label(__('Post Slug')),
                        ])
                        ->collapsible(),

                    Section::make(__('Tags and Categories'))
                        ->description(__('Tags and Categories Options'))
                        ->schema([
                            SpatieTagsInput::make('tags')
                                ->type('tag')
                                ->label(__('Tags')),

                            SpatieTagsInput::make('category')
                                ->type('category')
                                ->label(__('Categories')),
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
                                ->options(config('zeus-sky.models.postStatus')::pluck('label', 'name')),

                            TextInput::make('password')
                                ->label(__('Password'))
                                ->reactive()
                                ->visible(fn (Closure $get): bool => $get('status') === 'private'),

                            DateTimePicker::make('published_at')
                                ->label(__('published at'))
                                ->default(now()),

                            DateTimePicker::make('sticky_until')
                                ->label(__('Sticky Until')),
                        ])
                        ->collapsible(),

                    Section::make(__('Featured Image'))
                        ->schema([
                            Radio::make('featured_image_type')
                                ->label('')
                                ->reactive()
                                ->dehydrated(false)
                                ->afterStateHydrated(function (Closure $set, Closure $get) {
                                    $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                                    $set('featured_image_type', $setVal);
                                })
                                ->default('upload')
                                ->options([
                                    'upload' => __('upload'),
                                    'url' => __('url'),
                                ])
                                ->inline(),

                            SpatieMediaLibraryFileUpload::make('featured_image_upload')
                                ->collection('posts')
                                ->visible(fn (Closure $get) => $get('featured_image_type') === 'upload')
                                ->label(''),

                            TextInput::make('featured_image')
                                ->label(__('featured image url'))
                                ->visible(fn (Closure $get) => $get('featured_image_type') === 'url')
                                ->url(),
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
                    ->toggleable()
                    ->view('zeus::filament.columns.post-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A')),

                SpatieTagsColumn::make('tags')
                    ->label(__('Post Tags'))
                    ->toggleable()
                    ->type('tag'),

                SpatieTagsColumn::make('category')
                    ->label(__('Post Category'))
                    ->toggleable()
                    ->type('category'),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')->label(__('Edit')),
                    Action::make('Open')
                        ->color('warning')
                        ->icon('heroicon-o-external-link')
                        ->label(__('Open'))
                        ->url(fn (Post $record): string => route('post', ['slug' => $record]))
                        ->openUrlInNewTab(),
                    DeleteAction::make('delete')
                        ->label(__('Delete')),
                ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('Status'))
                    ->options(config('zeus-sky.models.postStatus')::pluck('label', 'name')),

                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),

                Filter::make('sticky')
                    ->label(__('Still Sticky'))
                    ->query(fn (Builder $query): Builder => $query->sticky()),

                Filter::make('not_sticky')
                    ->label(__('Not Sticky'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->whereDate('sticky_until', '<=', now())
                            ->orWhereNull('sticky_until')
                    ),

                Filter::make('sticky_only')
                    ->label(__('Sticky Only'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->where('post_type', 'post')
                            ->whereNotNull('sticky_until')
                    ),

                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
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
}

<?php

namespace LaraZeus\Sky\Filament\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\CreatePost;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\EditPost;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages\ListPosts;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;

// @mixin Builder<PostScope>
class PostResource extends SkyResource
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Post');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('post_tabs')
                    ->schema([
                        Tab::make(__('zeus-sky::cms.common.title_content'))
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('zeus-sky::cms.post.title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, $state, $context) {
                                        if ($context === 'edit') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),
                                config('zeus-sky.editor')::component()
                                    ->label(__('zeus-sky::cms.post.post_content')),
                            ]),

                        Tab::make(__('zeus-sky::cms.common.SEO'))
                            ->schema([
                                Hidden::make('user_id')
                                    ->default(auth()->user()->id ?? 0)
                                    ->required(),

                                Hidden::make('post_type')
                                    ->default('post')
                                    ->required(),

                                Textarea::make('description')
                                    ->maxLength(255)
                                    ->label(__('zeus-sky::cms.post.description'))
                                    ->hint(__('zeus-sky::cms.post.description_hint')),

                                TextInput::make('slug')
                                    ->unique()
                                    ->required()
                                    ->maxLength(255)
                                    ->label(__('zeus-sky::cms.post.slug')),
                            ]),

                        Tab::make(__('zeus-sky::cms.common.tags'))
                            ->schema([
                                SpatieTagsInput::make('tags')
                                    ->type('tag')
                                    ->label(__('zeus-sky::cms.post.tags')),

                                SpatieTagsInput::make('category')
                                    ->type('category')
                                    ->label(__('zeus-sky::cms.post.categories')),
                            ]),

                        Tab::make(__('zeus-sky::cms.common.visibility'))
                            ->schema([
                                Select::make('status')
                                    ->label(__('zeus-sky::cms.post.status_label'))
                                    ->default('publish')
                                    ->required()
                                    ->live()
                                    ->options(SkyPlugin::get()->getEnum('PostStatus')),

                                TextInput::make('password')
                                    ->label(__('zeus-sky::cms.post.password'))
                                    ->visible(fn (Get $get): bool => $get('status')->value === 'private'),

                                DateTimePicker::make('published_at')
                                    ->label(__('zeus-sky::cms.post.published_at'))
                                    ->required()
                                    ->native(false)
                                    ->default(now()),

                                DateTimePicker::make('sticky_until')
                                    ->native(false)
                                    ->label(__('zeus-sky::cms.post.sticky_until')),
                            ]),

                        Tab::make(__('zeus-sky::cms.common.image'))
                            ->schema([
                                ToggleButtons::make('featured_image_type')
                                    ->dehydrated(false)
                                    ->hiddenLabel()
                                    ->live()
                                    ->afterStateHydrated(function (Set $set, Get $get) {
                                        $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                                        $set('featured_image_type', $setVal);
                                    })
                                    ->grouped()
                                    ->options([
                                        'upload' => __('zeus-sky::cms.post.upload'),
                                        'url' => __('zeus-sky::cms.post.url'),
                                    ])
                                    ->default('upload'),
                                SpatieMediaLibraryFileUpload::make('featured_image_upload')
                                    ->collection('posts')
                                    ->disk(SkyPlugin::get()->getUploadDisk())
                                    ->directory(SkyPlugin::get()->getUploadDirectory())
                                    ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                                    ->label(''),

                                TextInput::make('featured_image')
                                    ->label(__('zeus-sky::cms.post.featured_image_url'))
                                    ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                                    ->url(),
                            ]),
                    ])
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        /** @var view-string $postTitleView */
        $postTitleView = 'zeus::filament.columns.post-title';

        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('zeus-sky::cms.post.title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view($postTitleView),

                TextColumn::make('status')
                    ->label(__('zeus-sky::cms.post.status_label'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A'))
                    ->description(fn ($record) => optional($record->published_at)->diffForHumans()),

                SpatieTagsColumn::make('tags')
                    ->label(__('zeus-sky::cms.post.tags'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->type('tag'),

                SpatieTagsColumn::make('category')
                    ->label(__('zeus-sky::cms.post.categories'))
                    ->toggleable()
                    ->type('category'),
            ])
            ->defaultSort('id', 'desc')
            ->recordActions(static::getActions())
            ->toolbarActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('zeus-sky::cms.post.status_label'))
                    ->options(SkyPlugin::get()->getEnum('PostStatus')),

                Filter::make('password')
                    ->label(__('zeus-sky::cms.post.password_protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),

                Filter::make('sticky')
                    ->label(__('zeus-sky::cms.post.sticky_until'))
                    // @phpstan-ignore-next-line
                    ->query(fn (Builder $query): Builder => $query->sticky()),

                Filter::make('not_sticky')
                    ->label(__('zeus-sky::cms.post.not_sticky'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->whereDate('sticky_until', '<=', now())
                            ->orWhereNull('sticky_until')
                    ),

                Filter::make('sticky_only')
                    ->label(__('zeus-sky::cms.post.sticky_only'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->where('post_type', 'post')
                            ->whereNotNull('sticky_until')
                    ),

                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('zeus-sky::cms.post.tags')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('zeus-sky::cms.post.Label');
    }

    public static function getPluralLabel(): string
    {
        return __('zeus-sky::cms.post.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('zeus-sky::cms.post.navigation_label');
    }

    public static function getNavigationBadge(): ?string
    {
        if (! SkyPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        /** @var class-string<Post> $postModel */
        $postModel = SkyPlugin::get()->getModel('Post');

        return (string) $postModel::posts()->count();
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit'),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('zeus-sky::cms.open_action'))
                ->visible(! config('zeus-sky.headless'))
                ->url(fn (Post $record): string => route(
                    SkyPlugin::get()->getRouteNamePrefix() . 'post',
                    ['slug' => $record]
                ))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        if (
            class_exists(HelenServiceProvider::class)
            && ! config('zeus-sky.headless')
        ) {
            // @phpstan-ignore-next-line
            $action[] = ShortUrlAction::make('get-link')
                ->distUrl(fn (Post $record): string => route(
                    SkyPlugin::get()->getRouteNamePrefix() . 'post',
                    ['slug' => $record]
                ));
        }

        return [ActionGroup::make($action)];
    }
}

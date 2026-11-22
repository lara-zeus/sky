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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use LaraZeus\Helen\Actions\ShortUrlAction;
use LaraZeus\Helen\HelenServiceProvider;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages\CreatePage;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages\EditPage;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages\ListPage;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;

class PageResource extends SkyResource
{
    protected static ?string $slug = 'pages';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 2;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Post');
    }

    /**
     * @return Builder<Post>
     */
    public static function getEloquentQuery(): Builder
    {
        /** @var Builder<Post> $query */
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('post_tabs')
                ->columnSpan(2)
                ->schema([
                    Tab::make(__('zeus-sky::cms.common.title_content'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('zeus-sky::cms.page.title'))
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Set $set, $state) {
                                    $set('slug', Str::slug($state));
                                }),
                            config('zeus-sky.editor')::component(),
                        ]),
                    Tab::make(__('zeus-sky::cms.common.SEO'))
                        ->schema([
                            Hidden::make('user_id')
                                ->required()
                                ->default(auth()->user()->id),

                            Hidden::make('post_type')
                                ->default('page')
                                ->required(),

                            Textarea::make('description')
                                ->maxLength(255)
                                ->label(__('zeus-sky::cms.page.description'))
                                ->hint(__('zeus-sky::cms.page.description_hint')),

                            TextInput::make('slug')
                                ->unique()
                                ->required()
                                ->maxLength(255)
                                ->label(__('zeus-sky::cms.page.slug')),

                            Select::make('parent_id')
                                ->options(SkyPlugin::get()->getModel('Post')::where('post_type', 'page')->pluck(
                                    'title',
                                    'id'
                                ))
                                ->label(__('zeus-sky::cms.page.parent_page')),

                            TextInput::make('ordering')
                                ->integer()
                                ->label(__('zeus-sky::cms.page.page_order'))
                                ->default(1),
                        ]),
                    Tab::make(__('zeus-sky::cms.common.visibility'))
                        ->schema([
                            Select::make('status')
                                ->label(__('zeus-sky::cms.page.status'))
                                ->default('publish')
                                ->required()
                                ->live()
                                ->options(SkyPlugin::get()->getEnum('PostStatus')),

                            TextInput::make('password')
                                ->label(__('zeus-sky::cms.page.password'))
                                ->visible(fn (Get $get): bool => $get('status') === 'private'),

                            DateTimePicker::make('published_at')
                                ->label(__('zeus-sky::cms.page.published_at'))
                                ->required()
                                ->default(now()),
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
                                    'upload' => __('zeus-sky::cms.page.upload'),
                                    'url' => __('zeus-sky::cms.page.url'),
                                ])
                                ->default('upload'),
                            SpatieMediaLibraryFileUpload::make('featured_image_upload')
                                ->collection('pages')
                                ->disk(SkyPlugin::get()->getUploadDisk())
                                ->directory(SkyPlugin::get()->getUploadDirectory())
                                ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                                ->label(''),
                            TextInput::make('featured_image')
                                ->label(__('zeus-sky::cms.page.featured_image_url'))
                                ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                                ->url(),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        /** @var view-string $pageTitleView */
        $pageTitleView = 'zeus::filament.columns.page-title';

        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('zeus-sky::cms.page.title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view($pageTitleView),

                TextColumn::make('status')
                    ->label(__('zeus-sky::cms.page.status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->tooltip(fn (Post $record): string => $record->published_at->format('Y/m/d | H:i A'))
                    ->description(fn ($record) => optional($record->published_at)->diffForHumans()),
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
                    ->label(__('zeus-sky::cms.page.status'))
                    ->options(SkyPlugin::get()->getEnum('PostStatus')),
                Filter::make('password')
                    ->label(__('zeus-sky::cms.page.password_protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPage::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('zeus-sky::cms.page.Label');
    }

    public static function getPluralLabel(): string
    {
        return __('zeus-sky::cms.page.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('zeus-sky::cms.page.navigation_label');
    }

    public static function getNavigationBadge(): ?string
    {
        if (! SkyPlugin::getNavigationBadgesVisibility(static::class)) {
            return null;
        }

        /** @var class-string<Post> $postModel */
        $postModel = SkyPlugin::get()->getModel('Post');

        return (string) $postModel::page()->count();
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
                    SkyPlugin::get()->getRouteNamePrefix() . 'page',
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
                    SkyPlugin::get()->getRouteNamePrefix() . 'page',
                    ['slug' => $record]
                ));
        }

        return [ActionGroup::make($action)];
    }
}

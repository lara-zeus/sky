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
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages;
use LaraZeus\Sky\Models\Post;

class PageResource extends SkyResource
{
    protected static ?string $slug = 'pages';

    protected static ?string $navigationIcon = 'iconpark-folder-o';

    public static function getModel(): string
    {
        return config('zeus-sky.models.post');
    }

    /**
     * @return Builder<Post>
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Post Title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->reactive()
                                    ->afterStateUpdated(function (Closure $set, $state) {
                                        $set('slug', Str::slug($state));
                                    }),

                                config('zeus-sky.editor')::component(),
                            ]),
                    ])
                    ->columnSpan(3),

                Grid::make()
                    ->schema([
                        Section::make(__('SEO'))
                            ->description(__('SEO Settings'))
                            ->schema([
                                Hidden::make('user_id')
                                    ->required()
                                    ->default(auth()->user()->id),

                                Hidden::make('post_type')
                                    ->default('page')
                                    ->required(),

                                Textarea::make('description')
                                    ->maxLength(255)
                                    ->label(__('Description'))
                                    ->hint(__('Write an excerpt for your post')),

                                TextInput::make('slug')
                                    ->unique(ignorable: fn(?Post $record): ?Post => $record)
                                    ->required()
                                    ->maxLength(255)
                                    ->label(__('Post Slug')),

                                Select::make('parent_id')
                                    ->options(config('zeus-sky.models.post')::where('post_type', 'page')->pluck('title',
                                        'id'))
                                    ->label(__('Parent Page')),

                                TextInput::make('ordering')
                                    ->integer()
                                    ->label(__('Page Order'))
                                    ->default(1),
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
                                    ->visible(fn(Closure $get): bool => $get('status') === 'private'),

                                DateTimePicker::make('published_at')
                                    ->label(__('published at'))
                                    ->default(now()),
                            ])
                            ->collapsible(),

                        Section::make(__('Featured Image'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->collection('pages')
                                    ->label(''),
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
                    ->view('zeus::filament.columns.page-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn(Post $record): string => $record->published_at->format('Y/m/d | H:i A')),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')->label(__('Edit')),
                    Action::make('Open')
                        ->color('warning')
                        ->icon('heroicon-o-external-link')
                        ->label(__('Open'))
                        ->url(fn(Post $record): string => route('page', ['slug' => $record]))
                        ->openUrlInNewTab(),
                    DeleteAction::make('delete'),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('Status'))
                    ->options(config('zeus-sky.models.postStatus')::pluck('label', 'name')),
                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('password')),
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
        return __('Page');
    }

    public static function getPluralLabel(): string
    {
        return __('Pages');
    }

    public static function getNavigationLabel(): string
    {
        return __('Pages');
    }
}

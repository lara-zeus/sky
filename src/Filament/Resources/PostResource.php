<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\SkyPlugin;
use Wallo\FilamentSelectify\Components\ButtonGroup;

// @mixin Builder<PostScope>
class PostResource extends SkyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getPostModel();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('post_tabs')->schema([
                Tabs\Tab::make(__('Title & Content'))->schema([
                    TextInput::make('title')
                        ->label(__('Post Title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state, $context) {
                            if ($context === 'edit') {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        }),
                    SkyPlugin::get()->getEditor()::component(),
                ]),

                Tabs\Tab::make(__('SEO'))->schema([
                    Placeholder::make(__('SEO Settings')),

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
                ]),
                Tabs\Tab::make(__('Tags'))->schema([
                    Placeholder::make(__('Tags and Categories')),
                    SpatieTagsInput::make('tags')
                        ->type('tag')
                        ->label(__('Tags')),

                    SpatieTagsInput::make('category')
                        ->type('category')
                        ->label(__('Categories')),
                ]),

                Tabs\Tab::make(__('Visibility'))->schema([
                    Placeholder::make(__('Visibility Options')),
                    Select::make('status')
                        ->label(__('status'))
                        ->default('publish')
                        ->required()
                        ->live()
                        ->options(SkyPlugin::get()->getPostStatusModel()::pluck('label', 'name')),

                    TextInput::make('password')
                        ->label(__('Password'))
                        ->visible(fn (Get $get): bool => $get('status') === 'private'),

                    DateTimePicker::make('published_at')
                        ->label(__('published at'))
                        ->native(false)
                        ->default(now()),

                    DateTimePicker::make('sticky_until')
                        ->native(false)
                        ->label(__('Sticky Until')),
                ]),

                Tabs\Tab::make(__('Image'))->schema([
                    Placeholder::make(__('Featured Image')),
                    ButtonGroup::make('featured_image_type')
                        ->live()
                        ->label('')
                        ->dehydrated(false)
                        ->afterStateHydrated(function (Set $set, Get $get) {
                            $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                            $set('featured_image_type', $setVal);
                        })
                        ->options([
                            'upload' => __('upload'),
                            'url' => __('url'),
                        ])
                        ->default('upload'),
                    SpatieMediaLibraryFileUpload::make('featured_image_upload')
                        ->collection('posts')
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                        ->label(''),

                    TextInput::make('featured_image')
                        ->label(__('featured image url'))
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                        ->url(),
                ]),
            ])->columnSpan(2),
        ]);
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
                    ->toggleable(isToggledHiddenByDefault: true)
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
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->label(__('Open'))
                        ->url(fn (Post $record): string => route('post', ['slug' => $record]))
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
                    ->options(SkyPlugin::get()->getPostStatusModel()::pluck('label', 'name')),

                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),

                Filter::make('sticky')
                    ->label(__('Still Sticky'))
                    // @phpstan-ignore-next-line
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

    public static function getNavigationLabel(): string
    {
        return __('Posts');
    }
}

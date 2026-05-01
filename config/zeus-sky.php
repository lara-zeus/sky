<?php

use LaraZeus\Sky\Classes\BoltParser;
use LaraZeus\Sky\Editors\RichEditor;
use LaraZeus\Sky\Enums\PostStatus;
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\Filament\Resources\LibraryResource;
use LaraZeus\Sky\Filament\Resources\NavigationResource;
use LaraZeus\Sky\Filament\Resources\PageResource;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\Filament\Resources\TagResource;
use LaraZeus\Sky\Models\Faq;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\Models\Navigation;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

return [
    'domain' => null,

    /**
     * disable all sky frontend routes.
     */
    'headless' => false,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'sky',

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * URI prefix for each content type
     */
    'uri' => [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->models([ ... ])
     */
    'models' => [
        'Faq' => Faq::class,
        'Post' => Post::class,
        'Tag' => Tag::class,
        'Library' => Library::class,
        'Navigation' => Navigation::class,
    ],

    'enums' => [
        'PostStatus' => PostStatus::class,
    ],

    'resource' => [
        'post' => PostResource::class,
        'page' => PageResource::class,
        'library' => LibraryResource::class,
        'faq' => FaqResource::class,
        'tag' => TagResource::class,
        'navigation' => NavigationResource::class,
    ],

    'parsers' => [
        BoltParser::class,
    ],

    'recentPostsLimit' => 5,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'],

    'defaultFeaturedImage' => null,

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Editors\TipTapEditor::class,
     * \LaraZeus\Sky\Editors\TinyEditor::class,
     * \LaraZeus\Sky\Editors\MarkdownEditor::class,
     * \LaraZeus\Sky\Editors\RichEditor::class,
     */
    'editor' => RichEditor::class,
];

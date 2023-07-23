<?php

return [
    /**
     * set the default path for the blogs homepage.
     */
    'path' => 'blog',

    /**
     * the middleware you want to apply on all the blogs routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    'uri_prefix' => [
        'post'=>'post',
        'page'=>'page',
        'library'=>'library',
        'faq'=>'faq',
    ],

    /**
     * customize the models
     */
    'models' => [
        'faq' => \LaraZeus\Sky\Models\Faq::class,
        'post' => \LaraZeus\Sky\Models\Post::class,
        'postStatus' => \LaraZeus\Sky\Models\PostStatus::class,
        'tag' => \LaraZeus\Sky\Models\Tag::class,
        'library' => \LaraZeus\Sky\Models\Library::class,
    ],

    /**
     * enable or disable individual Resources.
     */
    'enabled_resources' => [
        LaraZeus\Sky\Filament\Resources\PostResource::class,
        LaraZeus\Sky\Filament\Resources\PageResource::class,
        LaraZeus\Sky\Filament\Resources\TagResource::class,
        LaraZeus\Sky\Filament\Resources\FaqResource::class,
        LaraZeus\Sky\Filament\Resources\LibraryResource::class,
    ],

    /**
     * css class to apply on found search result, e.g. `bg-yellow-400`.
     */
    'search_result_highlight_css_class' => 'highlight',

    /**
     * supply a list of terms that will disable the search highlight to not
     * destroy html structure.
     */
    'skip_highlighting_terms' => ['iframe'],

    /**
     * Navigation Group Label
     */
    'navigation_group_label' => 'sky',

    /**
     * default featured image, set to null to disable it.
     * ex: https://placehold.co/600x400
     */
    'default_featured_image' => null,

    /**
     * these types help you to render the items in the FE
     * set it to null to hide it from the form
     */
    'library_types' => [
        'FILE' => 'File',
        'IMAGE' => 'Image',
        'VIDEO' => 'Video',
    ],

    /**
     * you can add more types to the Tags
     */
    'tags_types' => [
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ],

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Classes\TipTapEditor::class,
     * \LaraZeus\Sky\Classes\TinyEditor::class,
     * \LaraZeus\Sky\Classes\MarkdownEditor::class,
     */
    'editor' => \LaraZeus\Sky\Classes\TipTapEditor::class,

    /**
     * parse the content
     * you can add any parser to do str_replace or any other operation:
     *
     * to render Blot form by it slug: \LaraZeus\Sky\Classes\BoltParser::class,
     */
    'parsers' => [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ],
];

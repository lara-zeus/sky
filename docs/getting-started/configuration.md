---
title: Configuration
weight: 3
---

### Configuration

There is two different set of configuration, for filament, and for the frontend pages

## Filament Configuration

to configure the plugin Sky, you can pass the configuration to the plugin in `adminPanelProvider`

these all the available configuration, and their defaults values

```php
SpatieLaravelTranslatablePlugin::make()
    //If you don't use multi-language
    ->defaultLocales([config('app.locale')])
    // or if you have more
    ->defaultLocales(['en', 'pt']),

SkyPlugin::make()
    ->navigationGroupLabel('Sky')

    // uploading config
    ->uploadDisk()
    ->uploadDirectory()

    // the default models, by default Sky will read from the config file 'zeus-sky'.
    // but if you want to customize the models per panel, you can do it here 
    ->skyModels([
        // ...
        'Tag' => \LaraZeus\Sky\Models\Tag::class,
    ])

    // available tags
    ->tagTypes([
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ])

    // disable a Resource, if you dont use it, or want to replace them with your own resource
    ->postResource()
    ->pageResource()
    ->faqResource()
    ->libraryResource()
    ->tagResource()
    ->navigationResource()

    // hide a Resource, if you need to register them, but want to hide them from the sidebar navigation
    ->hideResources([
        FaqResource::class,
    ])
```

## Customize Filament Resources

you can customize all Sky resources icons and sorting by adding the following code to your `AppServiceProvider` boot method

```php
PostResource::navigationSort(100);
PostResource::navigationIcon('heroicon-o-home');
PostResource::navigationGroup('New Name');
```

available resources:

- FaqResource, 
- LibraryResource, 
- NavigationResource, 
- PageResource, 
- PostResource, 
- TagResource,

## Frontend Configuration

use the file `zeu-sky.php`, to customize the frontend, like the prefix, middleware and URI prefix for each content type.

to publish the configuration:

```bash
php artisan vendor:publish --tag=zeus-sky-config
```

and here is the config content:

```php
<?php

return [
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
     * ->skyModels([ ... ])
     */
    'models' => [
        'Faq' => \LaraZeus\Sky\Models\Faq::class,
        'Post' => \LaraZeus\Sky\Models\Post::class,
        'PostStatus' => \LaraZeus\Sky\Models\PostStatus::class,
        'Tag' => \LaraZeus\Sky\Models\Tag::class,
        'Library' => \LaraZeus\Sky\Models\Library::class,
    ],

    'parsers' => [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ],

    'recentPostsLimit' => 5,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'],

    'defaultFeaturedImage' => null,
    
    'editor' => \LaraZeus\Sky\Editors\RichEditor::class,
];
```

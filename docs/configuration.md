---
title: Configuration
weight: 3
---

## Configuration

to configure the plugin Sky, you can pass the configuration to the plugin in `adminPanelProvider`

these all the available configuration, and their defaults values

```php
SkyPlugin::make()
    ->skyPrefix('sky')
    ->skyMiddleware(['web'])
    ->uriPrefix([
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ])
    
    // enable or disable the resources
    ->hasPostResource()
    ->hasPageResource()
    ->hasFaqResource()
    ->hasLibraryResource()
    
    ->navigationGroupLabel('Sky')
    
    // the default models
    ->faqModel(\LaraZeus\Sky\Models\Faq::class)
    ->postModel(\LaraZeus\Sky\Models\Post::class)
    ->postStatusModel(\LaraZeus\Sky\Models\PostStatus::class)
    ->tagModel(\LaraZeus\Sky\Models\Tag::class)
    ->libraryModel(\LaraZeus\Sky\Models\Library::class)

    ->editor(Editors\TipTapEditor::class)
    ->parsers([\LaraZeus\Sky\Classes\BoltParser::class])
    ->recentPostsLimit(5)
    ->searchResultHighlightCssClass('highlight')
    ->skipHighlightingTerms(['iframe'])
    ->defaultFeaturedImage('url/to/image')
    ->libraryTypes([
        'FILE' => 'File',
        'IMAGE' => 'Image',
        'VIDEO' => 'Video',
    ])
    ->tagTypes([
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ])

```

## Content Editor

the default editor is: `TinyEditor`. and included:
* [Spatie Markdown Editor](https://filamentphp.com/plugins/spatie-markdown-editor)
* [Tiptap Editor](https://filamentphp.com/plugins/tiptap)

to use them you only need to install the package, and set the config 'editor'

### adding new editor

you can add any editor available in [filament plugin directory](https://filamentphp.com/plugins)
* first install the plugin that you want to use.
* implement the `\LaraZeus\Sky\Editors\ContentEditor` interface, and set it in the option `editor`

for example check `LaraZeus\Sky\Editors\MarkdownEditor`.

---
name: zeus-sky
description: Use when installing, configuring, or customizing the lara-zeus/sky CMS (posts, pages, tags, FAQs, library, navigation, and editors).
---

# Lara Zeus Sky (`lara-zeus/sky`)

## Overview & Requirements
`lara-zeus/sky` is a Filament v5 CMS for posts, pages, tags/categories, FAQs, libraries, and navigation menus.
- **PHP**: `^8.2`
- **Dependencies**: `lara-zeus/core` (`^5.0`), `lara-zeus/filament-plugin-tools` (`^3.0.3`), `filament/spatie-laravel-media-library-plugin` (`^5.0`), `filament/spatie-laravel-tags-plugin` (`^5.0`), `spatie/laravel-medialibrary` (`^11.0`), `spatie/laravel-sluggable` (`^3.3 || ^6.0`), `spatie/laravel-tags` (`^4.6`)

## Installation
```bash
composer require lara-zeus/sky
php artisan sky:install
```
`php artisan sky:install` publishes `zeus-sky-config`, `zeus-sky-migrations`, Spatie `tags-migrations`, `medialibrary-migrations`, `zeus-config`, and `zeus-assets`, and runs `php artisan migrate`.
For updating views/translations/assets later: `php artisan sky:publish` (`--force` supported).

## Configuration & Migrations
Published migrations: `create_posts_table`, `create_faqs_table`, `create_library_table`, `create_navigations_table` (plus Spatie `tags` and `media` migrations).

Key options in `config/zeus-sky.php`:
- `domain`, `prefix` (`'sky'`), `middleware` (`['web']`), `headless` (`false` — set `true` to disable web routes)
- `uri`: `['post' => 'post', 'page' => 'page', 'library' => 'library', 'faq' => 'faq']`
- `models`, `enums`, `resources`, `parsers` (defaults to `[BoltParser::class]`)
- `editor`: `LaraZeus\Sky\Editors\RichEditor::class` (also `MarkdownEditor::class`, `TinyEditor::class`)

## Filament Panel Registration
Register both `SpatieTranslatablePlugin` and `SkyPlugin` in your PanelProvider:
```php
use LaraZeus\Sky\Filament\Resources\FaqResource;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;

->plugins([
    SpatieTranslatablePlugin::make()->defaultLocales([config('app.locale')]),
    SkyPlugin::make()
        ->navigationGroupLabel('Sky')
        ->postResource()
        ->pageResource()
        ->faqResource()
        ->libraryResource()
        ->tagResource()
        ->navigationResource()
        ->hideResources([FaqResource::class]),
])
```
`SkyPlugin` also supports `->models([...])`, `->enums([...])`, `->resources([...])`, `->uploadDisk()`, `->uploadDirectory()`, `->tagTypes([...])`, `->libraryTypes([...])`, `->itemType($name, $fields, $slug)`, `->withExtraFields($schema)`, `->hideNavigationBadges()`, and `->showNavigationBadges()`.

## Core Usage
- **Frontend routes** (when `headless` is `false`): `blogs` (`/{prefix}`), `post` (`/{prefix}/{uri.post}/{slug}`), `page` (`/{prefix}/{uri.page}/{slug}`), `faq` (`/{prefix}/{uri.faq}`), `library` / `library.tag` / `library.item`, `tags` (`/{prefix}/{type}/{slug}`).
- **Fetch navigation menu**: `LaraZeus\Sky\Models\Navigation::fromHandle('main-header-menu')`.
- **Custom editor**: run `php artisan make:zeus-editor {plugin}` or implement `LaraZeus\Sky\Classes\ContentEditor` and configure `'editor'` in `config/zeus-sky.php`.

## Common Pitfalls
- **Missing Spatie tables**: Skipping `sky:install` without publishing Spatie `tags-migrations` and `medialibrary-migrations` causes runtime SQL errors on posts/tags/media.
- **Missing `SpatieTranslatablePlugin`**: Omitting `SpatieTranslatablePlugin` from the panel breaks translatable fields on Sky resources.
- **Wrong `ContentEditor` namespace**: The interface is `LaraZeus\Sky\Classes\ContentEditor`, not `LaraZeus\Sky\Editors\ContentEditor`.

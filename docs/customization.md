---
title: Customization
weight: 6
---

to customize the layout, you can change the default layout in the config file

```php
'layout' => 'zeus::components.app',
```

## Publishing the default layout

or if you don't have a layout yet, you can publish the default one:

```bash
php artisan vendor:publish --tag=zeus-views
```

## Publishing the default views

to customize the default views for sky:

```bash
php artisan vendor:publish --tag=zeus-views
```

## Publishing Translations

to customize the translations:

```bash
php artisan vendor:publish --tag=zeus-sky-translations
```


## Navigations
to render the navigation:
```
@php $menu = RyanChandler\FilamentNavigation\Models\Navigation::fromHandle('main-header-menu'); @endphp
@foreach($menu->items as $item)
    {!! \LaraZeus\Sky\Classes\RenderNavItem::render($item,'px-5 py-2 text-sm font-medium text-gray-600 hover:text-blue-500 dark:text-gray-400') !!}
@endforeach
```

you can also copy the `RenderNavItem` class and customize it as you need.

for more information refer to the main plugin [Filament Navigation](https://github.com/ryangjchandler/filament-navigation)

## themes
soon

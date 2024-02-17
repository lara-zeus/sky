---
title: UI Customization
weight: 6
---

to customize the layout, you can change the default layout in the `zeus.php` config file

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
@php $menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main-header-menu'); @endphp
@foreach($menu->items as $item)
    {!! \LaraZeus\Sky\Classes\RenderNavItem::render($item,'px-5 py-2 text-sm font-medium text-gray-600 hover:text-blue-500 dark:text-gray-400') !!}
@endforeach
```

you can also copy the `RenderNavItem` class and customize it as you need.

the navigation plugin was originally created by [ryangjchandler](https://github.com/ryangjchandler/filament-navigation). and now it's included in sky plugin.

## themes

you can create any frontend themes you want, checkout @zeus Artemis for more

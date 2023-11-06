---
title: Upgrading
weight: 100
---


## upgrade to v3.3

remove `FilamentNavigation::make(),` from your panel plugins

if you published the config file, add the `Navigation` key to the `models` array

```php
'models' => [
        //...
        'Navigation' => \LaraZeus\Sky\Models\Navigation::class,
    ],
```

## upgrade to v3.2

In v3.2, I refactored the configuration to separate the frontend configuration from filament-related ones.
This causes an issue when having multiple panels.

1. First, publish the config file by running the command:

```bash
php artisan vendor:publish --tag="zeus-sky-config" --force
```

2. move your configuration from your panel provider to the `zeus-sky` config file.

So these are the deprecated configuration methods:

```php

->skyPrefix()
->skyMiddleware()
->uriPrefix()
->skyModels()
->editor()
->parsers()
->recentPostsLimit()
->searchResultHighlightCssClass()
->skipHighlightingTerms()
->defaultFeaturedImage()

```


## upgrade from 2 to 3

to upgrade `Sky` from v2 to v3 please check this [upgrade guid](https://larazeus.com/docs/core/v3/upgrade) 

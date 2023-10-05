---
title: Upgrading
weight: 100
---

## upgrade to v3.2

in v3.2 I refactor the configuration, to separate the frontend configuration from filament related ones.
this case issues when having multiple panels.

first publish the config file by running:

```bash
php artisan vendor:publish --tag="zeus-sky-config" --force
```

now move your configuration form your panel provider to the `zeus-sky` config file.

so these are the deprecated configuration methods:

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

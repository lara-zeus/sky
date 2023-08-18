---
title: addons
weight: 7
---

## Addons

Sky comes with some addons, currently we have:

- FAQ
- Library

## FAQ Addons

to set the url of the FAQ from the `zeus-sky.php` config file:

```php
->uriPrefix([
        'faq' => 'faq',
    ])
```

to disable it, set it in the `adminPanelProvider`:
```php
->hasFaqResource(),
```

## Library Addons

to set the url of the Library from the `zeus-sky.php` config file:

```php
->uriPrefix([
        'library' => 'library',
    ])
```

to disable it, set it in the `adminPanelProvider`:
```php
->hasLibraryResource(),
```

---
title: Addons
weight: 7
---

## Addons

Sky comes with some addons, currently we have:

- FAQ
- Library

## FAQ Addons

to set the url of the FAQ from the `zeus-sky.php` config file:

```php
'uri' => [
    // ...
    'faq' => 'faq',
],
```

to disable it in the admin, set it in the `adminPanelProvider`:
```php
SkyPlugin::make()
    ->faqResource(false),
```

## Library Addons

to set the url of the Library from the `zeus-sky.php` config file:

```php
'uri' => [
    // ...
    'library' => 'library',
],
```

to disable it, set it in the `adminPanelProvider`:
```php
SkyPlugin::make()
    ->libraryResource(false),
```

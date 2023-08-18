---
title: Installation
weight: 2
---

before you continue, please make sure you already installed filament, and all working prefecture for you.

## Composer

You can install the package via composer:

```bash
composer require lara-zeus/sky
```

## Migrations
to publish the migrations files

```bash
php artisan vendor:publish --tag=zeus-sky-migrations
php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="tags-migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```

## Assets
to publish the assets files for the frontend:

```bash
php artisan vendor:publish --tag=zeus-assets
```

## Run Migration
finally, run the migration:

```bash
php artisan migrate
```

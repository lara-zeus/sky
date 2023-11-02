---
title: Installation
weight: 2
---

## Prerequisites

Sky is built on top of [laravel](https://laravel.com/docs/master) and uses [filament](https://filamentphp.com/docs/3.x/panels/installation) as an admin panel to manage everything.

And for the frontend, it uses [Tall stack](https://tallstack.dev/).
So, ensure you are familiar with these tools before diving into @zeus Sky.

> **Note**\
> You can get up and running with our [starter kit Zeus](https://github.com/lara-zeus/zeus).

## Installation

> **Important**\
> Before starting, make sure you have the following PHP extensions enabled:
`sqlite`

Install @zeus Sky by running the following commands in your Laravel project directory.

```bash
composer require lara-zeus/sky
php artisan sky:install
```

The install command will publish the migrations and the necessary assets for the frontend.

## Register Sky with Filament:

```php
->plugins([
    SpatieLaravelTranslatablePlugin::make()->defaultLocales([config('app.locale')]),
    SkyPlugin::make(),
])
```

## Usage

To access the forms, visit the URL `/admin` , and `/sky`.
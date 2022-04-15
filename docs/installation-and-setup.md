---
title: Installation and Setup
weight: 2
---

## Installation

You can install the package via composer:

```bash
composer require lara-zeus/wind
```

then run the command to install and publish all Wind components

```bash
php artisan wind:publish
```


which will run the following commands:

```bash
php artisan vendor:publish --tag=zeus-wind-config
php artisan vendor:publish --tag=zeus-wind-migrations
php artisan vendor:publish --tag=zeus-wind-views
php artisan vendor:publish --tag=zeus-wind-seeder
php artisan vendor:publish --tag=zeus-wind-factories
php artisan vendor:publish --tag=zeus-zeus-config
php artisan vendor:publish --tag=zeus-zeus-views
php artisan vendor:publish --tag=zeus-zeus-assets
```

you can pass `--force` option to force publishing all files

```bash
php artisan wind:publish --force
```

## Usage

visit the url `/admin` to manage the Letters, and `/contact-us` to access the contact form.
> you can configure the URL from the config file

if you dont have a user, or it's a fresh instalation of laravel, you can use the command to create a new user
```bash
php artisan make:filament-user
```

More Documentation are coming soon...

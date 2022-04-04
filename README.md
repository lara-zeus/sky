<h1 align="center">Lara Zeus Sky</h1>

<p align="center">
<a href="https://larazeus.com"><img src="https://larazeus.com/images/zeus-sky-banner.png" /></a>
</p>

<p align="center">
<a href="https://packagist.org/packages/lara-zeus/sky"><img src="https://img.shields.io/packagist/v/lara-zeus/sky?style=flat-square" /></a>
<a href="https://github.styleci.io/repos/438676758?branch=main"><img src="https://github.styleci.io/repos/438676758/shield?branch=main" alt="StyleCI"></a>
<a href="https://packagist.org/packages/lara-zeus/sky"><img src="https://img.shields.io/packagist/dt/lara-zeus/sky?style=flat-square" /></a>
<a href="https://github.com/lara-zeus/sky"><img src="https://img.shields.io/github/stars/lara-zeus/sky?style=flat-square" /></a>
<a href="https://www.codefactor.io/repository/github/lara-zeus/sky"><img src="https://www.codefactor.io/repository/github/lara-zeus/sky/badge" alt="CodeFactor" /></a>
</p>

Lara-zeus sky is a Blog and simple CMS for your website.
>small tasks can be time-consuming, let us build these for you,

## features
- 🔥 built with [TALL stack](https://tallstack.dev/)
- 🔥 using [filament](https://filamentadmin.com) as an admin panel
- 🔥 optionally you can add categories to the contact form like 'sales','dev','report bug' etc.
- 🔥 you can add logos for all categories.
- 🔥 direct URL to contact on specific category.

## Demo

> visit our website to get the full documentation: https://larazeus.com/sky

> real use: https://atm-code.com/contact-us

## Installation

You can install the package via composer:

```bash
composer require lara-zeus/sky
```

run the command:

```bash
php artisan sky:publish

php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="tags-migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"

php artisan vendor:publish --tag="filament-forms-tinyeditor-assets"
php artisan vendor:publish --tag="filament-browser-js"
php artisan vendor:publish --tag=filament-colorpicker-views
```

## Usage

visit the url `/admin` to manage the Letters, and `/contact-us` to access the contact form.

## Full Documentation

> visit our website to get the full documentation: https://larazeus.com/sky

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wh7r.com@gmail.com instead of using the issue tracker.

## Credits

-   [Ashraf Monshi](https://github.com/atmonshi)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

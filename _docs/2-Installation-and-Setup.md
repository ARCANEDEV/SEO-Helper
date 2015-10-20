# 2. Installation

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/seo-helper`.

Or by adding the package to your `composer.json`.

```json
{
    "require": {
        "arcanedev/seo-helper": "~0.15"
    }
}
```

Then install it via `composer install` or `composer update`.

## Laravel

### Setup

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\SeoHelper\SeoHelperServiceProvider::class,
],
```

And for the Facades:

```php
// config/app.php

'aliases' => [
    ...
    'SeoHelper'    => Arcanedev\SeoHelper\Facades\SeoHelper::class,

    // OR, by choosing a specific SEO Manager.
    'SeoMeta'      => Arcanedev\SeoHelper\Facades\SeoMeta::class,
    'SeoOpenGraph' => Arcanedev\SeoHelper\Facades\SeoOpenGraph::class,
    'SeoTwitter'   => Arcanedev\SeoHelper\Facades\SeoTwitter::class,
];
```

### Artisan commands

To publish the config file, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\SeoHelper\SeoHelperServiceProvider"
```

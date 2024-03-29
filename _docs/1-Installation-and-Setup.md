# 1. Installation

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)
  4. [API](4-API.md)
  5. [Extras](5-Extras.md)

## Version Compatibility

| Laravel                        | SEO-Helper                             |
|:-------------------------------|:---------------------------------------|
| ![Laravel v11.x][laravel_11_x] | ![SEO-Helper v7.x][seo_helper_7_x]     |
| ![Laravel v10.x][laravel_10_x] | ![SEO-Helper v6.x][seo_helper_6_x]     |
| ![Laravel v9.x][laravel_9_x]   | ![SEO-Helper v5.x][seo_helper_5_x]     |
| ![Laravel v8.x][laravel_8_x]   | ![SEO-Helper v4.x][seo_helper_4_x]     |
| ![Laravel v7.x][laravel_7_x]   | ![SEO-Helper v3.x][seo_helper_3_x]     |
| ![Laravel v6.x][laravel_6_x]   | ![SEO-Helper v2.x][seo_helper_2_x]     |
| ![Laravel v5.8][laravel_5_8]   | ![SEO-Helper v1.7.x][seo_helper_1_7_x] |
| ![Laravel v5.7][laravel_5_7]   | ![SEO-Helper v1.6.x][seo_helper_1_6_x] |
| ![Laravel v5.6][laravel_5_6]   | ![SEO-Helper v1.5.x][seo_helper_1_5_x] |
| ![Laravel v5.5][laravel_5_5]   | ![SEO-Helper v1.4.x][seo_helper_1_4_x] |
| ![Laravel v5.4][laravel_5_4]   | ![SEO-Helper v1.3.x][seo_helper_1_3_x] |
| ![Laravel v5.3][laravel_5_3]   | ![SEO-Helper v1.2.x][seo_helper_1_2_x] |
| ![Laravel v5.2][laravel_5_2]   | ![SEO-Helper v1.2.x][seo_helper_1_2_x] |
| ![Laravel v5.1][laravel_5_1]   | ![SEO-Helper v1.2.x][seo_helper_1_2_x] |
| ![Laravel v5.0][laravel_5_0]   | ![SEO-Helper v1.1.x][seo_helper_1_1_x] |

[laravel_11_x]:  https://img.shields.io/badge/v11.x-supported-brightgreen.svg?style=flat-square "Laravel v11.x"
[laravel_10_x]:  https://img.shields.io/badge/v10.x-supported-brightgreen.svg?style=flat-square "Laravel v10.x"
[laravel_9_x]:  https://img.shields.io/badge/v9.x-supported-brightgreen.svg?style=flat-square "Laravel v9.x"
[laravel_8_x]:  https://img.shields.io/badge/v8.x-supported-brightgreen.svg?style=flat-square "Laravel v8.x"
[laravel_7_x]:  https://img.shields.io/badge/v7.x-supported-brightgreen.svg?style=flat-square "Laravel v7.x"
[laravel_6_x]:  https://img.shields.io/badge/v6.x-supported-brightgreen.svg?style=flat-square "Laravel v6.x"
[laravel_5_8]:  https://img.shields.io/badge/v5.8-supported-brightgreen.svg?style=flat-square "Laravel v5.8"
[laravel_5_7]:  https://img.shields.io/badge/v5.7-supported-brightgreen.svg?style=flat-square "Laravel v5.7"
[laravel_5_6]:  https://img.shields.io/badge/v5.6-supported-brightgreen.svg?style=flat-square "Laravel v5.6"
[laravel_5_5]:  https://img.shields.io/badge/v5.5-supported-brightgreen.svg?style=flat-square "Laravel v5.5"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"

[seo_helper_7_x]:   https://img.shields.io/badge/version-7.x-blue.svg?style=flat-square "SEO-Helper v7.x"
[seo_helper_6_x]:   https://img.shields.io/badge/version-6.x-blue.svg?style=flat-square "SEO-Helper v6.x"
[seo_helper_5_x]:   https://img.shields.io/badge/version-5.x-blue.svg?style=flat-square "SEO-Helper v5.x"
[seo_helper_4_x]:   https://img.shields.io/badge/version-4.x-blue.svg?style=flat-square "SEO-Helper v4.x"
[seo_helper_3_x]:   https://img.shields.io/badge/version-3.x-blue.svg?style=flat-square "SEO-Helper v3.x"
[seo_helper_2_x]:   https://img.shields.io/badge/version-2.x-blue.svg?style=flat-square "SEO-Helper v2.x"
[seo_helper_1_7_x]: https://img.shields.io/badge/version-1.7.x-blue.svg?style=flat-square "SEO-Helper v1.7.x"
[seo_helper_1_6_x]: https://img.shields.io/badge/version-1.6.x-blue.svg?style=flat-square "SEO-Helper v1.6.x"
[seo_helper_1_5_x]: https://img.shields.io/badge/version-1.5.x-blue.svg?style=flat-square "SEO-Helper v1.5.x"
[seo_helper_1_4_x]: https://img.shields.io/badge/version-1.4.x-blue.svg?style=flat-square "SEO-Helper v1.4.x"
[seo_helper_1_3_x]: https://img.shields.io/badge/version-1.3.x-blue.svg?style=flat-square "SEO-Helper v1.3.x"
[seo_helper_1_2_x]: https://img.shields.io/badge/version-1.2.x-blue.svg?style=flat-square "SEO-Helper v1.2.x"
[seo_helper_1_1_x]: https://img.shields.io/badge/version-1.1.x-blue.svg?style=flat-square "SEO-Helper v1.1.x"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/seo-helper`.

## Laravel

### Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\SeoHelper\SeoHelperServiceProvider::class,
],
```

### Artisan commands

To publish the config file, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\SeoHelper\SeoHelperServiceProvider"
```

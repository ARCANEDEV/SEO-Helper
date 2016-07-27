# 3. Configuration

> Note: This is only for the laravel users (artisans).

## Table of contents

0. [Home](0-Home.md)
1. [Requirements](1-Requirements.md)
2. [Installation and Setup](2-Installation-and-Setup.md)
3. [Configuration](3-Configuration.md)
  * [Title](#title)
  * [Description](#description)
  * [Keywords](#keywords)
  * [Miscellaneous](#miscellaneous)
  * [Webmaster Tools](#webmaster-tools)
  * [Open Graph](#open-graph)
  * [Twitter](#twitter)
  * [Analytics](#analytics)
4. [Usage](4-Usage.md)
5. [API](5-API.md)
6. [Extras](6-Extras.md)

After you've published the config file `config/seo-helper.php`, you can customize the settings :

### Title

```php
'title' => [
    'default'   => 'Default title',
    'site-name' => '',
    'separator' => '-',
    'first'     => true,
    'max'       => 55,
],
```

### Description

```php
'description' => [
    'default'   => 'Default description',
    'max'       => 155,
],
```

### Keywords

```php
'keywords'  => [
    'default'   => [
        //
    ],
],
```

### Miscellaneous

```php
'misc'      => [
    'canonical' => true,
    'robots'    => config('app.env') !== 'production',
    'default'   => [
        'viewport'  => 'width=device-width, initial-scale=1',
        'author'    => '', // https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]
        'publisher' => '', // https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]
    ],
],
```

### Webmaster Tools

```php
'webmasters' => [
    'google'    => '',
    'bing'      => '',
    'alexa'     => '',
    'pinterest' => '',
    'yandex'    => '',
],
```

### Open Graph

```php
'open-graph' => [
    'enabled'     => true,
    'prefix'      => 'og:',
    'type'        => 'website',
    'title'       => 'Default Open Graph title',
    'description' => 'Default Open Graph description',
    'site-name'   => '',
    'properties'  => [
        //
    ],
],
```

### Twitter

```php
'twitter' => [
    'enabled' => true,
    'prefix'  => 'twitter:',
    'card'    => 'summary',
    'site'    => 'Username',
    'title'   => 'Default Twitter Card title',
    'metas'   => [
        //
    ],
],
```

### Analytics

```php
'analytics' => [
    'google' => '', // UA-XXXXXXXX-X
],
```

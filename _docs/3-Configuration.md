# 3. Configuration

> Note: This is only for the laravel users (artisans).

## Table of contents

* [Title](#title)
* [Description](#description)
* [Keywords](#keywords)
* [Miscellaneous](#miscellaneous)
* [Webmaster Tools](#webmaster-tools)
* [Analytics](#analytics)
* [Open Graph](#open-graph)
* [Twitter](#twitter)

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
    'robots'    => ! app()->environment('production'),
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

### Analytics

```php
'analytics' => [
    'google' => '', // UA-XXXXXXXX-X
],
```

### Open Graph

```php
'open-graph' => [
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
    'prefix' => 'twitter:',
    'card'   => 'summary',
    'site'   => 'Username',
    'title'  => 'Default Twitter Card title',
    'metas'  => [
        //
    ],
],
```

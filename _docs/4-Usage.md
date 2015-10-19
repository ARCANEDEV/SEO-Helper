# 4. Usage

> **:warning: DISCLAIMER :** French speaker here ! Brace yourselves, omelette du fromage is coming.

## Table of contents

1. [Entities](#1-entities)
  * [Title](#title)
  * [Description](#description)
  * [Keywords](#keywords)
  * [Miscellaneous Tags](#miscellaneous-tags)
  * [Webmasters](#webmasters)
  * [Open Graph](#open-graph)
  * [Twitter Card](#twitter-card)
2. [Helpers](#2-helpers)
  * [Meta](#meta)
3. [Managers](#3-managers)
  * [SEO Meta](#seo-meta)
  * [SEO Open Graph](#seo-open-graph)
  * [SEO Twitter Card](#seo-twitter-card)
4. [Laravel Usage](#4-laravel-usage)

## 1. Entities

All the `Entities` classes are located in `Arcanedev\SeoHelper\Entities` namespace and they implements the `Arcanedev\SeoHelper\Contracts\Renderable` interface.

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

interface Renderable
{
    /**
     * Render the tag.
     *
     * @return string
     */
    public function render();

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString();
}
```

### Title

To start, you need to make a new instance of the `Title` class.

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = new Title;
$title->set('Your awesome title');

echo $title->render();
```

> Output:

```html
<title>Your awesome title</title>
```

If you need to add a site name to the title:

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = new Title;
$title->set('Your awesome title');
$title->setSiteName('Company name');

echo $title->render();
```

> Output:

```html
<title>Your awesome title - Company name</title>
```

The default title separator is `-`, you can modifying it by doing this:

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = new Title;
$title->set('Your awesome title');
$title->setSeparator('|');
$title->setSiteName('Company name');

echo $title->render();
```

> Output:

```html
<title>Your awesome title | Company name</title>
```

By the way, you can chain all these methods :

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = new Title;
$title->set('Your awesome title')
      ->setSeparator('|')
      ->setSiteName('Company name');

echo $title->render();
```

> Output:

```html
<title>Your awesome title | Company name</title>
```

You can also `make` the title object:

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = Title::make('Your awesome title', 'Company name', '|');

echo $title->render();
```

> Output:

```html
<title>Your awesome title | Company name</title>
```

> :information_source: The **site name** and **separator** are **optionals**, you can simply do this `Title::make('Your awesome title');`.

To switch the title and site name positions:

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = Title::make('Your awesome title', 'Company name', '|');
$title->setLast();

echo $title->render();
```

> Output:

```html
<title>Company name | Your awesome title</title>
```

To reset the title position, use `setFirst()` method.

> :information_source: You know that the title must be optimized for the SEO, Right ?? So the optimal title length is **55** characters long.

```php
use Arcanedev\SeoHelper\Entities\Title;

$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$title   = Title::make($content);

echo $title->render();
```

> Output:

```html
<title>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</title>
```

You can specify the maximum length by using the `setMax()` method :

```php
use Arcanedev\SeoHelper\Entities\Title;

$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$title   = Title::make($content);

$title->setMax(60);

echo $title->render();
```

> Output:

```html
<title>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed...</title>
```

And last but not least, the `Title` class constructor accepts an array as an argument:

| Key         | Type      | Required | Description                |
| ----------- | --------- | -------- | -------------------------- |
| `default`   | `string`  | Yes      | The default title content. |
| `site-name` | `string`  | No       | The site name.             |
| `separator` | `string`  | No       | The title separator.       |
| `max`       | `integer` | No       | The maximum title length.  |

```php
use Arcanedev\SeoHelper\Entities\Title;

$title = new Title([
    'default'   => 'Your awesome title',
    'separator' => '|',
    'site-name' => 'Company name',
    'max'       => 60
]);

echo $title->render();
```

> Output:

```html
<title>Your awesome title | Company name</title>
```

> :information_source: You can also echo out the `$title` object like this `echo $title;`.

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#title).

### Description

Let's start by making a new instance of the `Description` class.

```php
use Arcanedev\SeoHelper\Entities\Description;

$description = new Description;
$description->set('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.');

echo $description->render();
```

> Output:

```html
<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.">
```

You can also specify the maximum length by using the `setMax()` method (default max is **155**):

```php
use Arcanedev\SeoHelper\Entities\Description;

$description = new Description;
$description->set('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.');
$description->setMax(100);

echo $description->render();
```

> Output:

```html
<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum,...">
```

> :information_source: Don't forget you can chain the methods.

If you want to `make` a Description object:

```php
use Arcanedev\SeoHelper\Entities\Description;

$content     = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$description = Description::make($content, 100);

echo $description->render();
```

> Output:

```html
<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum,...">
```

And last but not least, the `Description` class constructor accepts an array as an argument:

| Key         | Type      | Required | Description                      |
| ----------- | --------- | -------- | -------------------------------- |
| `default`   | `string`  | Yes      | The default description content. |
| `max`       | `integer` | No       | The maximum title length.        |

```php
use Arcanedev\SeoHelper\Entities\Description;

$description = new Description([
    'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.',
    'max'       => 100,
]);

echo $description->render();
```

> Output:

```html
<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum,...">
```

> :information_source: You can also echo out the `$description` object like this `echo $description;`.

For more details, check the [Description API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#description).

### Keywords

So far so good, let's make the `Keywords` object now.

```php
use Arcanedev\SeoHelper\Entities\Keywords;

$keywords = new Keywords;
$keywords->set([
    'seo-helper', 'is', 'awesome', 'cool', 'easy', 'php', 'package'
]);

echo $keywords->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package">
```

You can also pass a string as an argument (to separate the keywords use `,` - Comma separated).

```php
use Arcanedev\SeoHelper\Entities\Keywords;

$keywords = new Keywords;
$keywords->set('seo-helper, is, awesome, cool, easy, php, package');

echo $keywords->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package">
```

If you want to `add` more keywords:

```php
use Arcanedev\SeoHelper\Entities\Keywords;

$keywords = new Keywords;
$keywords->set([
    'seo-helper', 'is', 'awesome', 'cool', 'easy', 'php', 'package'
]);
$keywords->add('laravel')->add('supported');

echo $keywords->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package, laravel, supported">
```

You can also pass an array as argument to the constructor:

| Key         | Type            | Required | Description                   |
| ----------- | --------------- | -------- | ----------------------------- |
| `default`   | `array|string`  | Yes      | The default keywords content. |

```php
use Arcanedev\SeoHelper\Entities\Keywords;

$content  = ['seo-helper', 'is', 'awesome', 'cool', 'easy', 'php', 'package'];
// or
$content  = 'seo-helper, is, awesome, cool, easy, php, package';

$keywords = new Keywords([
    'default' => $content,
]);

echo $keywords->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package">
```

And if you want to `make` a Keywords object:

```php
use Arcanedev\SeoHelper\Entities\Keywords;

$keywords = Keywords::make([
    'seo-helper', 'is', 'awesome', 'cool', 'easy', 'php', 'package'
]);

// OR
$keywords = Keywords::make('seo-helper, is, awesome, cool, easy, php, package');

echo $keywords->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package">
```

For more details, check the [Keywords API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#keywords).

### Miscellaneous Tags

Same thing as usual, we start by creating a `MiscTags` object:

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

$tags = new MiscTags;

$tags->add('copyright', 'ARCANEDEV');

echo $tags->render();
```

> Output:

```html
<meta name="keywords" content="seo-helper, is, awesome, cool, easy, php, package">
```

Ok, lets add many tags:

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

$tags = new MiscTags;

$tags->addMany([
    'copyright' => 'ARCANEDEV',
    'viewport'  => 'width=device-width, initial-scale=1',
]);

echo $tags->render();
```

> Output:

```html
<meta name="copyright" content="ARCANEDEV">
<meta name="viewport" content="width=device-width, initial-scale=1">
```

For the `canonical` link tag, there are many ways to achieve it :

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

// 1st example:
$tags   = new MiscTags;

$tags->add('canonical', 'http://www.example.com/');

// 2nd example:
$tags   = new MiscTags([
   'default' => [
       'canonical' => 'http://www.example.com/',
   ],
]);

// 3rd example:
$tags   = new MiscTags([
   'canonical' => true,
]);

$tags->setUrl('http://www.example.com/');

// And Finally:
echo $tags->render();
```

> Output:

```html
<link rel="canonical" href="http://www.example.com/">
```

> :information_source: the `setUrl()` method is used to set the `canonical` URL.

Same here for `robots` meta tag:

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

// 1st example:
$tags = new MiscTags;

$tags->add('robots', 'noindex, nofollow');

// 2nd example:
$tags   = new MiscTags([
  'default'   => [
      'robots'    => 'noindex, nofollow',
  ],
]);

// 3rd example:
$tags = new MiscTags([
    'robots' => true,
]);

// And finally:
echo $tags->render();
```

> Output:

```html
<meta name="robots" content="noindex, nofollow">
```

> :information_source: As you can see, the `canonical` and `robots` tags got a spacial treatment.

As you can see, the `MiscTags` constructor accept an array as argument:

| Key         | Type      | Required | Description                                                                           |
| ----------- | --------- | -------- | ------------------------------------------------------------------------------------- |
| `canonical` | `boolean` | No       | Enable automatic generation for `canonical` link tag.                                 |
| `robots`    | `boolean` | No       | Enable the `robots` meta tag to prevent from the indexation by the search engines.    |
| `default`   | `array`   | No       | A `key => value` array that represent the `name` and `content` of miscellaneous tags. |

For example:

```php
$data = [
    'canonical' => true,
    'robots'    => true,  // true (for local environment) and false (for production environment)
    'default'   => [
        'viewport'  => 'width=device-width, initial-scale=1', // Responsive design thing
        'author'    => 'https://plus.google.com/+ArcanedevNetMaroc',
        // ...
    ],
];
```

Ok, now we're going to `remove` some tags:

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

$tags = new MiscTags;

$tags->addMany([
    'copyright' => 'ARCANEDEV',
    'viewport'  => 'width=device-width, initial-scale=1',
]);

$tags->remove('viewport');

echo $tags->render();
```

> Output:

```html
<meta name="copyright" content="ARCANEDEV">
```

> :information_source: you can remove many tags by passing an array of names like this: `$tags->remove(['copyright', 'viewport']);`.

If you want to `reset` all tags:

```php
use Arcanedev\SeoHelper\Entities\MiscTags;

$tags = new MiscTags([
    'canonical' => true,
    'robots'    => true,
]);

$tags->setUrl('http://www.example.com/');

$tags->addMany([
    'copyright' => 'ARCANEDEV',
    'viewport'  => 'width=device-width, initial-scale=1',
]);

$tags->reset();

$tags->add('copyright', 'ARCANEDEV');

echo $tags->render();
```

> Output:

```html
<meta name="copyright" content="ARCANEDEV">
```

For more details, check the [Miscellaneous Tags API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#miscellaneous-tags).

### Webmasters

```php
```

For more details, check the [Webmasters API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#webmasters).

### Open Graph

```php
```

For more details, check the [Open Graph API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#open-graph).

### Twitter Card

```php
```

For more details, check the [Twitter Card API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#twitter-card).

## 2. Helpers

### Meta

```php
```

For more details, check the [Meta API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#meta).

## 3. Managers

### SEO Meta

```php
```

For more details, check the [SEO Meta API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#seo-meta).

### SEO Open Graph

```php
```

For more details, check the [SEO Open Graph API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#seo-open-graph).

### SEO Twitter Card

```php
```

For more details, check the [SEO Twitter Card API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#seo-twitter-card).

## 4. Laravel Usage

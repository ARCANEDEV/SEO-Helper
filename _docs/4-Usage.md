# 4. Usage

## Table of contents

1. [Entities](#1-entities)
  * [Title](#title)
  * [Description](#description)
  * [Keywords](#keywords)
  * [Miscellaneous Tags](#miscellaneous-tags)
  * [Webmasters](#webmasters)
  * [Open Graph](#open-graph)
  * [Twitter Card](#twitter-card)
2. [Helpers] 

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

You can chain all these methods :

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

> **Note :** You know that the title must be optimized for SEO, Right ?? So the optimal title length is **55** characters long.

```php
use Arcanedev\SeoHelper\Entities\Title;

$raw   = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$title = Title::make($raw);

echo $title->render();
```

> Output:

```html
<title>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</title>
```

You can specify the length by:

```php
use Arcanedev\SeoHelper\Entities\Title;

$raw   = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$title = Title::make($raw);

$title->setMax(60);

echo $title->render();
```

> Output:

```html
<title>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed...</title>
```

And last but not least, the `Title` class constructor accepts an array as an argument:

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

> Note: You can also echo out the `$title` object like this `echo $title;`.

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

You can also specify the max length, the default max is **155**:

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

> Note: Don't forget you can chain the methods.

If you want to `make` a Description object:

```php
use Arcanedev\SeoHelper\Entities\Description;

$raw         = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum, tellus mi congue magna.';
$description = Description::make($raw, 100);

echo $description->render();
```

> Output:

```html
<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, sapien id interdum fermentum,...">
```

And last but not least, the `Description` class constructor accepts an array as an argument:

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

> Note: You can also echo out the `$description` object like this `echo $description;`.

For more details, check the [Description API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#description).

### Keywords

```php
```

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#keywords).

### Miscellaneous Tags

```php
```

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#miscellaneous-tags).

### Webmasters

```php
```

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#webmasters).

### Open Graph

```php
```

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#open-graph).

### Twitter Card

```php
```

For more details, check the [Title API](https://github.com/ARCANEDEV/SEO-Helper/blob/master/_docs/5-API.md#twitter-card).

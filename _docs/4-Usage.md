# 4. Usage

> **:warning: DISCLAIMER :** French speaker here ! Brace yourselves, omelette du fromage is coming.

## Table of contents

1. [Entities](#1-entities)
  * [Title](#title)
  * [Description](#description)
  * [Keywords](#keywords)
  * [Miscellaneous Tags](#miscellaneous-tags)
  * [Webmasters](#webmasters)
  * [Analytics](#analytics)
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

For more details, check the [Title API](5-API.md#title).

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
| `max`       | `integer` | No       | The maximum description length.  |

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

For more details, check the [Description API](5-API.md#description).

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

For more details, check the [Keywords API](5-API.md#keywords).

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

> :information_source: The `setUrl()` method is used to set the `canonical` URL.

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

> :information_source: You can remove many tags by passing an array of names like this: `$tags->remove(['copyright', 'viewport']);`.

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

For more details, check the [Miscellaneous Tags API](5-API.md#miscellaneous-tags).

### Webmasters

Let's repeat the same process by creating a `Webmasters` object:

```php
use Arcanedev\SeoHelper\Entities\Webmasters;

$webmasters = new Webmasters;

$webmasters->add('google', 'google-site-verification-code');

echo $webmasters->render();
```

> Output:

```html
<meta name="google-site-verification" content="google-site-verification-code">
```

The supported `webmasters` are:

| Name      | Key         |
| --------- | ----------- |
| Google    | `google`    |
| Bing      | `bing`      |
| Alexa     | `alexa`     |
| Pinterest | `pinterest` |
| Yandex    | `yandex`    |

> :information_source: You can also check some [useful links about Webmaster Tools](6-Extras.md#webmaster-tools)

If you want to add many `webmasters` at once:

```php
use Arcanedev\SeoHelper\Entities\Webmasters;

$webmasters = new Webmasters([
    'google'    => 'google-site-verification-code',
    'bing'      => 'bing-site-verification-code',
    'alexa'     => 'alexa-site-verification-code',
    'pinterest' => 'pinterest-site-verification-code',
    'yandex'    => 'yandex-site-verification-code'
]);

// OR by using the make() method

$webmasters = Webmasters::make([
    'google'    => 'google-site-verification-code',
    'bing'      => 'bing-site-verification-code',
    'alexa'     => 'alexa-site-verification-code',
    'pinterest' => 'pinterest-site-verification-code',
    'yandex'    => 'yandex-site-verification-code'
]);

echo $webmasters->render();
```

> Output:

```html
<meta name="google-site-verification" content="google-site-verification-code">
<meta name="msvalidate.01" content="bing-site-verification-code">
<meta name="alexaVerifyID" content="alexa-site-verification-code">
<meta name="p:domain_verify" content="pinterest-site-verification-code">
<meta name="yandex-verification" content="yandex-site-verification-code">
```

To `reset` and clean all your `webmasters`, you just do this:

```php
use Arcanedev\SeoHelper\Entities\Webmasters;

$webmasters = Webmasters::make([
    'google'    => 'google-site-verification-code',
    'bing'      => 'bing-site-verification-code',
    'alexa'     => 'alexa-site-verification-code',
    'pinterest' => 'pinterest-site-verification-code',
    'yandex'    => 'yandex-site-verification-code'
]);

$webmasters->reset();

$webmasters->add('google', 'new-google-site-verification-code');

echo $webmasters->render();
```

> Output:

```html
<meta name="google-site-verification" content="new-google-site-verification-code">
```

For more details, check the [Webmasters API](5-API.md#webmasters).

### Analytics

For the analytics, it's very simple, with start by creating an `Analytics` object:

```php
use Arcanedev\SeoHelper\Entities\Analytics;

$analytics = new Analytics;

$analytics->setGoogle('UA-12345678-9');

echo $analytics->render();
```

> Output:

```html
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-12345678-9', 'auto');
    ga('send', 'pageview');
</script>
```

For the time being, **only Google Analytics is supported**, so you can set the tracking code by using `setGoogle()` method.

Also, the `Analytics` constructor accepts an array as argument:

```php
use Arcanedev\SeoHelper\Entities\Analytics;

$analytics = new Analytics([
    'google' => 'UA-12345678-9',
]);

echo $analytics->render();
```

> Output:

```html
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-12345678-9', 'auto');
    ga('send', 'pageview');
</script>
```

For more details, check the [Analytics API](5-API.md#analytics).

### Open Graph

It's pretty darn easy, right ? for the open graph protocol, same old stuff :

```php
use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;

$openGraph = new Graph;

$openGraph->setType('website');
$openGraph->setTitle('Your awesome title');
$openGraph->setDescription('Your awesome description');
$openGraph->setSiteName('Your site name');
$openGraph->setUrl('http://my.awesome-website.com');
$openGraph->setImage('http://my.awesome-website.com/img/cool-image.jpg');
// Of course you can chain all these methods

echo $openGraph->render();
```

> Output:

```html
<meta property="og:type" content="website">
<meta property="og:title" content="Your awesome title">
<meta property="og:description" content="Your awesome description">
<meta property="og:site_name" content="Your site name">
<meta property="og:url" content="http://my.awesome-website.com">
<meta property="og:image" content="http://my.awesome-website.com/img/cool-image.jpg">
```

You can add more custom properties by using `addProperty()` or `addProperties()` methods:

```php
use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;

$openGraph = new Graph;

$openGraph->setType('website');
$openGraph->setTitle('Your awesome title');
$openGraph->setDescription('Your awesome description');
$openGraph->setSiteName('Your site name');

$openGraph->addProperty('locale', 'en_GB');
$openGraph->addProperty('locale:alternate', 'fr_FR');
// OR
$openGraph->addProperties([
    'locale'           => 'en_GB',
    'locale:alternate' => 'fr_FR',
]);

echo $openGraph->render();
```

> Output:

```html
<meta property="og:type" content="website">
<meta property="og:title" content="Your awesome title">
<meta property="og:description" content="Your awesome description">
<meta property="og:site_name" content="Your site name">
<meta property="og:locale" content="en_GB">
<meta property="og:locale:alternate" content="fr_FR">
```

You can also pass an array as argument to the `Graph` constructor:

```php
use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;

$openGraph = new Graph([
    'prefix'      => 'og:',
    'type'        => 'website',
    'title'       => 'Default Open Graph title',
    'description' => 'Default Open Graph description',
    'site-name'   => 'Your site name',
    'properties'  => [
        'locale'            => 'en_GB',
        'profile:username'  => 'ARCANEDEV'
        // ...
    ],
]);
```

| Key           | Type     | Description                                                                                           |
| ------------- | -------- | ----------------------------------------------------------------------------------------------------- |
| `prefix`      | `string` | The property prefix name (Default is `'og:'`).                                                          |
| `type`        | `string` | The title of your object as it should appear within the graph.                                        |
| `title`       | `string` | The type of your object (For more details : [The graph types](http://ogp.me/#types)).                 |
| `description` | `string` | A one to two sentence description of your object.                                                     |
| `site-name`   | `string` | If your object is part of a larger web site, the name which should be displayed for the overall site. |
| `properties`  | `array`  | The other graph properties (**no need to prefix the names**).                                         |

> **Source :** [The Open Graph protocol documentation](http://ogp.me).

For more details, check the [Open Graph API](5-API.md#open-graph).

### Twitter Card

We are going to start by creating a Twitter `Card` object:

```php
use Arcanedev\SeoHelper\Entities\Twitter\Card;

$card = new Card;

$card->setType('summary');
$card->setSite('@Arcanedev');         // Or just 'Arcanedev'
$card->setTitle('Your awesome title');
$card->setDescription('Your awesome description');
$card->addImage('http://my.awesome-website.com/img/cool-image.jpg');

echo $card->render();
```

> Output:

```html
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@Arcanedev">
<meta name="twitter:title" content="Your awesome title">
<meta name="twitter:description" content="Your awesome description">
<meta name="twitter:image" content="http://my.awesome-website.com/img/cool-image.jpg">
```

> :information_source: **The supported Twitter Card types are :** `'app'`, `'gallery'`, `'photo'`, `'player'`, `'product'`, `'summary'`, `'summary_large_image'`.

You can also add more `Card` meta tags by using the `addMeta()` method :

```php
use Arcanedev\SeoHelper\Entities\Twitter\Card;

$card = new Card;

$card->setType('gallery');
$card->setSite('@Arcanedev');
$card->addMeta('creator', '@Arcanedev');
$card->setTitle('Your awesome title');
$card->setDescription('Your awesome description');
$card->addMeta('url', 'http://my.awesome-website.com');
$card->addImage('http://my.awesome-website.com/img/cool-image.jpg');

echo $card;
```

> Output:

```html
<meta name="twitter:card" content="gallery">
<meta name="twitter:site" content="@Arcanedev">
<meta name="twitter:creator" content="@Arcanedev">
<meta name="twitter:title" content="Your awesome title">
<meta name="twitter:description" content="Your awesome description">
<meta name="twitter:url" content="http://my.awesome-website.com">
<meta name="twitter:image" content="http://my.awesome-website.com/img/cool-image.jpg">
```

> :information_source: To add multiple meta tags at once, use the `addMetas()` method.

If you want to reset all `Card` meta tags, use the `reset()` method:

```php
use Arcanedev\SeoHelper\Entities\Twitter\Card;

$card = new Card;

$card->setType('gallery');
$card->setSite('@Arcanedev');
$card->addMeta('creator', '@Arcanedev');
$card->setTitle('Your awesome title');
$card->setDescription('Your awesome description');
$card->addMeta('url', 'http://my.awesome-website.com');
$card->addImage('http://my.awesome-website.com/img/cool-image.jpg');

$card->reset();

$card->setType('summary');

echo $card;
```

> Output:

```html
<meta name="twitter:card" content="summary">
```

You can pass an array as argument to `Card` constructor:

```php
use Arcanedev\SeoHelper\Entities\Twitter\Card;

$card = new Card([
    'prefix' => 'twitter:',
    'card'   => 'summary',
    'site'   => '@Arcanedev',
    'title'  => 'Your awesome title',
    'metas'  => [
        'description' => 'Your awesome description',
        'creator'     => '@Arcanedev',
        'url'         => 'http://my.awesome-website.com',
        'image'       => 'http://my.awesome-website.com/img/cool-image.jpg',
        // ...
    ],
]);

echo $card;
```

> Output:

```html
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@Arcanedev">
<meta name="twitter:title" content="Your awesome title">
<meta name="twitter:description" content="Your awesome description">
<meta name="twitter:creator" content="@Arcanedev">
<meta name="twitter:url" content="http://my.awesome-website.com">
<meta name="twitter:image" content="http://my.awesome-website.com/img/cool-image.jpg">
```

| Key      | Type     | Description                                                                                           |
| -------- | -------- | ------------------------------------------------------- |
| `prefix` | `string` | The meta prefix name (Default is `'twitter:'`).         |
| `card`   | `string` | The twitter card type.                                  |
| `site`   | `string` | The twitter username.                                   |
| `title`  | `string` | The title as it should appear within the card.          |
| `metas`  | `array`  | The other card metas (**no need to prefix the names**). |

For more details, check the [Twitter Card API](5-API.md#twitter-card).

## 2. Helpers

### Meta

You can start making custom meta tags by instantiating the `Meta` class:

```php
use Arcanedev\SeoHelper\Helpers\Meta;

$meta = new Meta('copyright', 'ARCANEDEV');

echo $meta->render();
```

> Output:

```html
<meta name="copyright" content="ARCANEDEV">
```

(Add description here...)

```php
use Arcanedev\SeoHelper\Helpers\Meta;

$meta = new Meta('Content-Type', 'text/html; charset=UTF-8', 'http-equiv');

echo $meta;
```

> Output:

```html
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
```

(Add description here...)

```php
use Arcanedev\SeoHelper\Helpers\Meta;

$meta = new Meta('custom-name', 'meta content', 'itemprop', 'arc:');

echo $meta;
```

> Output:

```html
<meta itemprop="arc:custom-name" content="meta content">
```

You can use the `make` method to create a meta object:

```php
use Arcanedev\SeoHelper\Helpers\Meta;

$meta = Meta::make('custom-name', 'meta content', 'itemprop', 'arc:');

echo $meta;
```

> Output:

```html
<meta itemprop="arc:custom-name" content="meta content">
```

For more details, check the [Meta API](5-API.md#meta).

## 3. Managers

### SEO Meta

```php
```

For more details, check the [SEO Meta API](5-API.md#seo-meta).

### SEO Open Graph

```php
```

For more details, check the [SEO Open Graph API](5-API.md#seo-open-graph).

### SEO Twitter Card

```php
```

For more details, check the [SEO Twitter Card API](5-API.md#seo-twitter-card).

## 4. Laravel Usage

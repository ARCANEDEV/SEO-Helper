# 5. API

## Table of contents

1. [Contracts](#1-contracts)
  * [Renderable](#renderable)
2. [Entities](#2-entities)
  * [Title](#title)
  * [Description](#description)
  * [Keywords](#keywords)
  * [Miscellaneous Tags](#miscellaneous-tags)
  * [Webmasters](#webmasters)
  * [Analytics](#analytics)
  * [Open Graph](#open-graph)
  * [Twitter Card](#twitter-card)
3. [Helpers](#3-helpers)
  * [Meta](#meta)
3. [Managers](#3-manager)
  * [SEO Meta](#seo-meta)
  * [SEO Open Graph](#seo-open-graph)
  * [SEO Twitter Card](#seo-twitter-card)

## 1. Contracts

### Renderable

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

interface Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
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

## 2. Entities

### Title

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface TitleInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get title only (without site name or separator).
     *
     * @return string
     */
    public function getTitleOnly();

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function set($title);

    /**
     * Get site name.
     *
     * @return string
     */
    public function getSiteName();

    /**
     * Set site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Get title separator.
     *
     * @return string
     */
    public function getSeparator();

    /**
     * Set title separator.
     *
     * @param  string  $separator
     *
     * @return self
     */
    public function setSeparator($separator);

    /**
     * Set title first.
     *
     * @return self
     */
    public function setFirst();

    /**
     * Set title last.
     *
     * @return self
     */
    public function setLast();

    /**
     * Check if title is first.
     *
     * @return bool
     */
    public function isTitleFirst();

    /**
     * Get title max lenght.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set title max lenght.
     *
     * @param  int  $max
     *
     * @return self
     */
    public function setMax($max);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a Title instance.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public static function make($title, $siteName = '', $separator = '-');
}
```

### Description

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface DescriptionInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get raw description content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Get description content.
     *
     * @return string
     */
    public function get();

    /**
     * Set description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function set($content);

    /**
     * Get description max length.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set description max length.
     *
     * @param  int  $max
     *
     * @return self
     */
    public function setMax($max);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a description instance.
     *
     * @param  string  $content
     * @param  int     $max
     *
     * @return self
     */
    public static function make($content, $max = 155);
}
```

### Keywords

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface KeywordsInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return array
     */
    public function getContent();

    /**
     * Set description content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function set($content);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Keywords instance.
     *
     * @param  array|string  $keywords
     *
     * @return self
     */
    public static function make($keywords);

    /**
     * Add a keyword to the content.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function add($keyword);

    /**
     * Add many keywords to the content.
     *
     * @param  array  $keywords
     *
     * @return self
     */
    public function addMany(array $keywords);
}
```

### Miscellaneous Tags

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface MiscTagsInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the current URL.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make MiscTags instance.
     *
     * @param  array  $defaults
     *
     * @return self
     */
    public static function make(array $defaults = []);

    /**
     * Add a meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function add($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMany(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  array|string  $names
     *
     * @return self
     */
    public function remove($names);

    /**
     * Reset the meta collection.
     *
     * @return self
     */
    public function reset();
}
```

### Webmasters

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface WebmastersInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Webmaster instance.
     *
     * @param  array  $webmasters
     *
     * @return self
     */
    public static function make(array $webmasters = []);

    /**
     * Add a webmaster to collection.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return self
     */
    public function add($webmaster, $content);

    /**
     * Reset the webmaster collection.
     *
     * @return self
     */
    public function reset();
}
```

### Analytics

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface AnalyticsInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set Google Analytics code.
     *
     * @param  string  $code
     *
     * @return self
     */
    public function setGoogle($code);
}
```

### Open Graph

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface OpenGraphInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return self
     */
    public function setImage($image);

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return self
     */
    public function addProperties(array $properties);

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return self
     */
    public function addProperty($property, $content);
}
```

### Twitter Card

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface TwitterCardInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set card site.
     *
     * @param  string  $site
     *
     * @return self
     */
    public function setSite($site);

    /**
     * Set card title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set card description.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function addImage($url);

    /**
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Add a meta to the card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Reset the card.
     *
     * @return self
     */
    public function reset();
}
```

## 3. Helpers

### Meta

```php
<?php namespace Arcanedev\SeoHelper\Contracts\Helpers;

use Arcanedev\SeoHelper\Contracts\Renderable;

interface MetaInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the meta name.
     *
     * @return string
     */
    public function key();

    /**
     * Set the meta prefix name.
     *
     * @param  string  $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Set the meta property name.
     *
     * @param  string  $nameProperty
     *
     * @return self
     */
    public function setNameProperty($nameProperty);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Meta instance.
     *
     * @param  string  $name
     * @param  string  $content
     * @param  string  $propertyName
     * @param  string  $prefix
     *
     * @return self
     */
    public static function make($name, $content, $propertyName = 'name', $prefix = '');

    /**
     * Check if meta is valid.
     *
     * @return bool
     */
    public function isValid();
}
```

## 4. Managers

### SEO Meta

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

interface SeoMeta extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Title instance.
     *
     * @param  TitleInterface  $title
     *
     * @return self
     */
    public function title(TitleInterface $title);

    /**
     * Set the Description instance.
     *
     * @param  DescriptionInterface  $description
     *
     * @return self
     */
    public function description(DescriptionInterface $description);

    /**
     * Set the Keywords instance.
     *
     * @param  KeywordsInterface  $keywords
     *
     * @return self
     */
    public function keywords(KeywordsInterface $keywords);

    /**
     * Set the MiscTags instance.
     *
     * @param  MiscTagsInterface  $misc
     *
     * @return self
     */
    public function misc(MiscTagsInterface $misc);

    /**
     * Set the Webmasters instance.
     *
     * @param  WebmastersInterface  $webmasters
     *
     * @return self
     */
    public function webmasters(WebmastersInterface $webmasters);

    /**
     * Set the title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null);

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function setDescription($content);

    /**
     * Set the keywords content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function setKeywords($content);

    /**
     * Add a keyword.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function addKeyword($keyword);

    /**
     * Add many keywords.
     *
     * @param  array  $keywords
     *
     * @return self
     */
    public function addKeywords(array $keywords);

    /**
     * Add a webmaster tool site verifier.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return self
     */
    public function addWebmaster($webmaster, $content);

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Set the Google Analytics code.
     *
     * @param  string  $code
     *
     * @return self
     */
    public function setGoogleAnalytics($code);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Add a meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  string|array  $names
     *
     * @return self
     */
    public function removeMeta($names);

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return self
     */
    public function resetMetas();

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return self
     */
    public function resetWebmasters();
}
```

### SEO Open Graph

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;

interface SeoOpenGraph extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Open Graph instance.
     *
     * @param  OpenGraphInterface  $openGraph
     *
     * @return self
     */
    public function setOpenGraph(OpenGraphInterface $openGraph);

    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return self
     */
    public function setImage($image);

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return self
     */
    public function addProperties(array $properties);

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return self
     */
    public function addProperty($property, $content);
}
```

### SEO Twitter Card

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

interface SeoTwitter extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the twitter card instance.
     *
     * @param  TwitterCardInterface  $card
     *
     * @return self
     */
    public function setCard(TwitterCardInterface $card);

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set the card site.
     *
     * @param  string  $site
     *
     * @return self
     */
    public function setSite($site);

    /**
     * Set the card title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set the card description.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function addImage($url);

    /**
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Add a meta to the twitter card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Reset the twitter card.
     *
     * @return self
     */
    public function reset();
}
```

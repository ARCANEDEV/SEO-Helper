# 5. API

> **:warning: DISCLAIMER :** French speaker here ! Brace yourselves, omelette du fromage is coming.

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)
  4. [API](4-API.md)
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
    4. [Managers](#3-manager)
      * [SEO Helper](#seo-helper)
      * [SEO Meta](#seo-meta)
      * [SEO Open Graph](#seo-open-graph)
      * [SEO Twitter Card](#seo-twitter-card)
  5. [Extras](5-Extras.md)

## 1. Contracts

### Renderable

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

interface Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Title extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Description extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Keywords extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface MiscTags extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Webmasters extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Analytics extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

interface OpenGraph extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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

/**
 * Interface  TwitterCardInterface
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities\Twitter
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TwitterCard extends Renderable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */
    const TYPE_APP                 = 'app';
    const TYPE_GALLERY             = 'gallery';
    const TYPE_PHOTO               = 'photo';
    const TYPE_PLAYER              = 'player';
    const TYPE_PRODUCT             = 'product';
    const TYPE_SUMMARY             = 'summary';
    const TYPE_SUMMARY_LARGE_IMAGE = 'summary_large_image';

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Set the card type.
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
     * @param  string        $name
     * @param  string|array  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /**
     * Get all supported card types.
     *
     * @return array
     */
    public function types();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

interface Meta extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Make Meta instance.
     *
     * @param  string        $name
     * @param  string|array  $content
     * @param  string        $propertyName
     * @param  string        $prefix
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

### SEO Helper

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  SeoHelper
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoHelper extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Get SeoMeta instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoMeta
     */
    public function meta();

    /**
     * Set SeoMeta instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoMeta  $seoMeta
     *
     * @return self
     */
    public function setSeoMeta(SeoMeta $seoMeta);

    /**
     * Get SeoOpenGraph instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function openGraph();

    /**
     * Get SeoOpenGraph instance (alias).
     *
     * @see  openGraph()
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function og();

    /**
     * Get SeoOpenGraph instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoOpenGraph  $seoOpenGraph
     *
     * @return self
     */
    public function setSeoOpenGraph(SeoOpenGraph $seoOpenGraph);

    /**
     * Get SeoTwitter instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoTwitter
     */
    public function twitter();

    /**
     * Set SeoTwitter instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoTwitter  $seoTwitter
     *
     * @return self
     */
    public function setSeoTwitter(SeoTwitter $seoTwitter);

    /**
     * Set title.
     *
     * @param  string       $title
     * @param  string|null  $siteName
     * @param  string|null  $separator
     *
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null);
    
    /**
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);
        
    /**
     * Set description.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Set keywords.
     *
     * @param  array|string  $keywords
     *
     * @return self
     */
    public function setKeywords($keywords);

    /**
     * Set Image.
     *
     * @param  string  $imageUrl
     *
     * @return self
     */
    public function setImage($imageUrl);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Render all seo tags with HtmlString object.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function renderHtml();

    /**
     * Enable the OpenGraph.
     *
     * @return self
     */
    public function enableOpenGraph();

    /**
     * Disable the OpenGraph.
     *
     * @return self
     */
    public function disableOpenGraph();

    /**
     * Enable the Twitter Card.
     *
     * @return self
     */
    public function enableTwitter();

    /**
     * Disable the Twitter Card.
     *
     * @return self
     */
    public function disableTwitter();
}
```

### SEO Meta

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;

/**
 * Interface  SeoMeta
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoMeta extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Set the Title instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Title  $title
     *
     * @return self
     */
    public function title(TitleContract $title);

    /**
     * Set the Description instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Description  $description
     *
     * @return self
     */
    public function description(DescriptionContract $description);

    /**
     * Set the Keywords instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Keywords  $keywords
     *
     * @return self
     */
    public function keywords(KeywordsContract $keywords);

    /**
     * Set the MiscTags instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\MiscTags  $misc
     *
     * @return self
     */
    public function misc(MiscTagsContract $misc);

    /**
     * Set the Webmasters instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Webmasters  $webmasters
     *
     * @return self
     */
    public function webmasters(WebmastersContract $webmasters);

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
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);
    
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;

interface SeoOpenGraph extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Set the Open Graph instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\OpenGraph  $openGraph
     *
     * @return self
     */
    public function setOpenGraph(OpenGraphContract $openGraph);

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
     * Set the locale. 
     * 
     * @param  string  $locale 
     * 
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph 
     */ 
    public function setLocale($locale); 
 
    /** 
     * Set the alternative locales. 
     * 
     * @param  array  $locales 
     * 
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph 
     */ 
    public function setAlternativeLocales(array $locales); 
    
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
     * @param  string        $property
     * @param  string|array  $content 
     *
     * @return self
     */
    public function addProperty($property, $content);
}
```

### SEO Twitter Card

```php
<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Entities\Twitter\Card as CardContract;

interface SeoTwitter extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Set the twitter card instance.
     *
     * @param  \Arcanedev\SeoHelper\Entities\Twitter\Card  $card
     *
     * @return self
     */
    public function setCard(CardContract $card);

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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Reset the twitter card.
     *
     * @return self
     */
    public function reset();
}
```

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Graph
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Graph implements OpenGraphContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Configurable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The Open Graph meta collection.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    protected $metas;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Graph instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas = new MetaCollection;

        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        $this->setPrefix($this->getConfig('prefix', 'og:'));
        $this->setType($this->getConfig('type', ''));
        $this->setTitle($this->getConfig('title', ''));
        $this->setDescription($this->getConfig('description', ''));
        $this->setSiteName($this->getConfig('site-name', ''));
        $this->addProperties($this->getConfig('properties', []));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->metas->setPrefix($prefix);

        return $this;
    }

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return $this
     */
    public function setType($type)
    {
        return $this->addProperty('type', $type);
    }

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->addProperty('title', $title);
    }

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->addProperty('description', $description);
    }

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        return $this->addProperty('image', $image);
    }

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return $this
     */
    public function setSiteName($siteName)
    {
        return $this->addProperty('site_name', $siteName);
    }

    /**
     * Set the locale.
     *
     * @param  string  $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        return $this->addProperty('locale', $locale);
    }

    /**
     * Set the alternative locales.
     *
     * @param  array  $locales
     *
     * @return $this
     */
    public function setAlternativeLocales(array $locales)
    {
        return $this->addProperty('locale:alternate', $locales);
    }

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return $this
     */
    public function addProperties(array $properties)
    {
        $this->metas->addMany($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string        $property
     * @param  string|array  $content
     *
     * @return $this
     */
    public function addProperty($property, $content)
    {
        $this->metas->addOne($property, $content);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->metas->render();
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}

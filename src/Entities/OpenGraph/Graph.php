<?php namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Graph
 *
 * @package  Arcanedev\SeoHelper\Entities\OpenGraph
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Graph implements OpenGraphContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Configurable;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Open Graph meta collection.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    protected $metas;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
     */
    public function setSiteName($siteName)
    {
        return $this->addProperty('site_name', $siteName);
    }

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
     */
    public function addProperties(array $properties)
    {
        $this->metas->addMany($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
     */
    public function addProperty($property, $content)
    {
        $this->metas->add($property, $content);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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

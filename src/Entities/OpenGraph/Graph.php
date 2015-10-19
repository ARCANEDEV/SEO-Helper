<?php namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Graph
 *
 * @package  Arcanedev\SeoHelper\Entities\OpenGraph
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Graph implements OpenGraphInterface
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
     * @var MetaCollection
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
     * @return self
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
     * @return self
     */
    public function setType($type)
    {
        $this->addProperty('type', $type);

        return $this;
    }

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->addProperty('title', $title);

        return $this;
    }

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->addProperty('description', $description);

        return $this;
    }

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->addProperty('url', $url);

        return $this;
    }

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->addProperty('image', $image);

        return $this;
    }

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName)
    {
        $this->addProperty('site_name', $siteName);

        return $this;
    }

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return self
     */
    public function addProperties(array $properties)
    {
        foreach ($properties as $property => $content) {
            $this->metas->add($property, $content);
        }

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return self
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

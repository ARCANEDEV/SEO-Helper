<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     SeoOpenGraph
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraph implements SeoOpenGraphContract
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
     * Enable or Disable the OpenGraph.
     *
     * @var bool
     */
    protected $enabled;

    /**
     * The Open Graph instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\OpenGraph
     */
    protected $openGraph;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoOpenGraph instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);

        $this->setEnabled($this->getConfig('open-graph.enabled', false));
        $this->setOpenGraph(
            new Entities\OpenGraph\Graph($this->getConfig('open-graph', []))
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the enabled status for the OpenGraph.
     *
     * @param  bool  $enabled
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    private function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Set the Open Graph instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\OpenGraph  $openGraph
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setOpenGraph(OpenGraphContract $openGraph)
    {
        $this->openGraph = $openGraph;

        return $this;
    }

    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setPrefix($prefix)
    {
        $this->openGraph->setPrefix($prefix);

        return $this;
    }

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setType($type)
    {
        $this->openGraph->setType($type);

        return $this;
    }

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setTitle($title)
    {
        $this->openGraph->setTitle($title);

        return $this;
    }

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setDescription($description)
    {
        $this->openGraph->setDescription($description);

        return $this;
    }

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setUrl($url)
    {
        $this->openGraph->setUrl($url);

        return $this;
    }

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setImage($image)
    {
        $this->openGraph->setImage($image);

        return $this;
    }

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setSiteName($siteName)
    {
        $this->openGraph->setSiteName($siteName);

        return $this;
    }

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function addProperties(array $properties)
    {
        $this->openGraph->addProperties($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function addProperty($property, $content)
    {
        $this->openGraph->addProperty($property, $content);

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
        return $this->isEnabled() ? $this->openGraph->render() : '';
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

    /**
     * Enable the OpenGraph.
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function enable()
    {
        return $this->setEnabled(true);
    }

    /**
     * Disable the OpenGraph.
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function disable()
    {
        return $this->setEnabled(false);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the OpenGraph is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Check if the OpenGraph is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return ! $this->isEnabled();
    }
}

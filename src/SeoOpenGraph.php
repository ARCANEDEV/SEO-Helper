<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     SeoOpenGraph
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraph implements SeoOpenGraphContract
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

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
     * Set the locale.
     *
     * @param  string  $locale
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setLocale($locale)
    {
        $this->openGraph->setLocale($locale);

        return $this;
    }

    /**
     * Set the alternative locales.
     *
     * @param  array  $locales
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setAlternativeLocales(array $locales)
    {
        $this->openGraph->setAlternativeLocales($locales);

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

    /**
     * Set the enabled status for the OpenGraph.
     *
     * @param  bool  $enabled
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    private function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

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

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
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

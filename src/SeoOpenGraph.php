<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;
use Arcanedev\SeoHelper\Traits\{Configurable, HasEnabled};

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
    use HasEnabled;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The Open Graph instance.
     */
    protected OpenGraphContract $openGraph;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoOpenGraph instance.
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);
        $this->setEnabled($this->getConfig('open-graph.enabled', false));
        $this->setOpenGraph(new Graph($this->getConfig('open-graph', [])));
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

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Open Graph instance.
     *
     * @return $this
     */
    public function setOpenGraph(OpenGraphContract $openGraph): static
    {
        $this->openGraph = $openGraph;

        return $this;
    }

    /**
     * Set the open graph prefix.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static
    {
        $this->openGraph->setPrefix($prefix);

        return $this;
    }

    /**
     * Set the type property.
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->openGraph->setType($type);

        return $this;
    }

    /**
     * Set the title property.
     *
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->openGraph->setTitle($title);

        return $this;
    }

    /**
     * Set the description property.
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->openGraph->setDescription($description);

        return $this;
    }

    /**
     * Set the url property.
     *
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->openGraph->setUrl($url);

        return $this;
    }

    /**
     * Set image property.
     *
     * @return $this
     */
    public function setImage(string $image): static
    {
        $this->openGraph->setImage($image);

        return $this;
    }

    /**
     * Set site name property.
     *
     * @return $this
     */
    public function setSiteName(string $siteName): static
    {
        $this->openGraph->setSiteName($siteName);

        return $this;
    }

    /**
     * Set the locale.
     *
     * @return $this
     */
    public function setLocale(string $locale): static
    {
        $this->openGraph->setLocale($locale);

        return $this;
    }

    /**
     * Set the alternative locales.
     *
     * @return $this
     */
    public function setAlternativeLocales(array $locales): static
    {
        $this->openGraph->setAlternativeLocales($locales);

        return $this;
    }

    /**
     * Add many open graph properties.
     *
     * @return $this
     */
    public function addProperties(array $properties): static
    {
        $this->openGraph->addProperties($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @return $this
     */
    public function addProperty(string $property, string $content): static
    {
        $this->openGraph->addProperty($property, $content);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this->isEnabled() ? $this->openGraph->render() : '';
    }
}

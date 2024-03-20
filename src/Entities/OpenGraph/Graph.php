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
     */
    protected MetaCollection $metas;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Graph instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas = new MetaCollection();

        $this->init();
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
     * Set the open graph prefix.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static
    {
        $this->metas->setPrefix($prefix);

        return $this;
    }

    /**
     * Set the type property.
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        return $this->addProperty('type', $type);
    }

    /**
     * Set the title property.
     *
     * @return $this
     */
    public function setTitle(string $title): static
    {
        return $this->addProperty('title', $title);
    }

    /**
     * Set the description property.
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->addProperty('description', $description);
    }

    /**
     * Set the url property.
     *
     * @return $this
     */
    public function setUrl(string $url): static
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Set the image property.
     *
     * @return $this
     */
    public function setImage(string $image): static
    {
        return $this->addProperty('image', $image);
    }

    /**
     * Set the site name property.
     *
     * @return $this
     */
    public function setSiteName(string $siteName): static
    {
        return $this->addProperty('site_name', $siteName);
    }

    /**
     * Set the locale.
     *
     * @return $this
     */
    public function setLocale(string $locale): static
    {
        return $this->addProperty('locale', $locale);
    }

    /**
     * Set the alternative locales.
     *
     * @return $this
     */
    public function setAlternativeLocales(array $locales): static
    {
        return $this->addProperty('locale:alternate', $locales);
    }

    /**
     * Add many open graph properties.
     *
     * @return $this
     */
    public function addProperties(array $properties): static
    {
        $this->metas->addMany($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @return $this
     */
    public function addProperty(string $property, array|string $content): static
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
     */
    public function render(): string
    {
        return $this->metas->render();
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        $this
            ->setPrefix($this->getConfig('prefix', 'og:'))
            ->setType($this->getConfig('type', ''))
            ->setTitle($this->getConfig('title', ''))
            ->setDescription($this->getConfig('description', ''))
            ->setSiteName($this->getConfig('site-name', ''))
            ->addProperties($this->getConfig('properties', []))
        ;
    }
}

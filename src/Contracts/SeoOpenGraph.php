<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;

/**
 * Interface  SeoOpenGraph
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoOpenGraph extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Open Graph instance.
     *
     * @return $this
     */
    public function setOpenGraph(OpenGraphContract $openGraph): static;

    /**
     * Set the open graph prefix.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static;

    /**
     * Set the type property.
     *
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * Set the title property.
     *
     * @return $this
     */
    public function setTitle(string $title): static;

    /**
     * Set the description property.
     *
     * @return $this
     */
    public function setDescription(string $description): static;

    /**
     * Set the url property.
     *
     * @return $this
     */
    public function setUrl(string $url): static;

    /**
     * Set the image property.
     *
     * @return $this
     */
    public function setImage(string $image): static;

    /**
     * Set the site name property.
     *
     * @return $this
     */
    public function setSiteName(string $siteName): static;

    /**
     * Set the locale.
     *
     * @return $this
     */
    public function setLocale(string $locale): static;

    /**
     * Set the alternative locales.
     *
     * @return $this
     */
    public function setAlternativeLocales(array $locales): static;

    /**
     * Add many open graph properties.
     *
     * @return $this
     */
    public function addProperties(array $properties): static;

    /**
     * Add an open graph property.
     *
     * @return $this
     */
    public function addProperty(string $property, string $content): static;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enable(): static;

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disable(): static;

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the OpenGraph is enabled.
     */
    public function isEnabled(): bool;

    /**
     * Check if the OpenGraph is disabled.
     */
    public function isDisabled(): bool;
}

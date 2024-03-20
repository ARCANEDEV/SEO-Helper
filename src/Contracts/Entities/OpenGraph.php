<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  OpenGraph
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface OpenGraph extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the open graph prefix.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static;

    /**
     * Set type property.
     *
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * Set title property.
     *
     * @return $this
     */
    public function setTitle(string $title): static;

    /**
     * Set description property.
     *
     * @return $this
     */
    public function setDescription(string $description): static;

    /**
     * Set url property.
     *
     * @return $this
     */
    public function setUrl(string $url): static;

    /**
     * Set image property.
     *
     * @return $this
     */
    public function setImage(string $image): static;

    /**
     * Set site name property.
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
    public function addProperty(string $property, array|string $content): static;
}

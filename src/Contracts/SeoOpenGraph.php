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
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\OpenGraph  $openGraph
     *
     * @return $this
     */
    public function setOpenGraph(OpenGraphContract $openGraph);

    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix);

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url);

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return $this
     */
    public function setImage($image);

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return $this
     */
    public function setSiteName($siteName);

    /**
     * Set the locale.
     *
     * @param  string  $locale
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setLocale($locale);

    /**
     * Set the alternative locales.
     *
     * @param  array  $locales
     *
     * @return \Arcanedev\SeoHelper\SeoOpenGraph
     */
    public function setAlternativeLocales(array $locales);

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return $this
     */
    public function addProperties(array $properties);

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return $this
     */
    public function addProperty($property, $content);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enable();

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disable();

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */
    /**
     * Check if the OpenGraph is enabled.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Check if the OpenGraph is disabled.
     *
     * @return bool
     */
    public function isDisabled();
}

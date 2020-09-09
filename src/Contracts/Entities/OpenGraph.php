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
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
     */
    public function setLocale($locale);

    /**
     * Set the alternative locales.
     *
     * @param  array  $locales
     *
     * @return \Arcanedev\SeoHelper\Entities\OpenGraph\Graph
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
     * @param  string        $property
     * @param  string|array  $content
     *
     * @return $this
     */
    public function addProperty($property, $content);
}

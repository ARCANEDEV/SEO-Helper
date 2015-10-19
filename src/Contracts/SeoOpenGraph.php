<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;

/**
 * Interface  SeoOpenGraph
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoOpenGraph extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Open Graph instance.
     *
     * @param  OpenGraphInterface  $openGraph
     *
     * @return self
     */
    public function setOpenGraph(OpenGraphInterface $openGraph);

    /**
     * Set the open graph prefix.
     *
     * @param  string  $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Set type property.
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set title property.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set description property.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Set url property.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Set image property.
     *
     * @param  string  $image
     *
     * @return self
     */
    public function setImage($image);

    /**
     * Set site name property.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Add many open graph properties.
     *
     * @param  array  $properties
     *
     * @return self
     */
    public function addProperties(array $properties);

    /**
     * Add an open graph property.
     *
     * @param  string  $property
     * @param  string  $content
     *
     * @return self
     */
    public function addProperty($property, $content);
}

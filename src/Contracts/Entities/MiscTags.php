<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  MiscTags
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface MiscTags extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the current URL.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url);

    /**
     * Get all the metas collection.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    public function all();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     *
     * @param  array  $defaults
     *
     * @return $this
     */
    public static function make(array $defaults = []);

    /**
     * Add a meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function add($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMany(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  array|string  $names
     *
     * @return $this
     */
    public function remove($names);

    /**
     * Reset the meta collection.
     *
     * @return $this
     */
    public function reset();
}

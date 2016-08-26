<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  MetaCollection
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface MetaCollection extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Add a meta to collection.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function add($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMany(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  array|string  $names
     *
     * @return self
     */
    public function remove($names);
}

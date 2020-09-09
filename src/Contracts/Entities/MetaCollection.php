<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  MetaCollection
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface MetaCollection extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add a meta to collection.
     *
     * @param  string        $name
     * @param  string|array  $content
     *
     * @return $this
     */
    public function addOne($name, $content);

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
}

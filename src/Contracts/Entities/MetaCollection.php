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
     * @return $this
     */
    public function addOne(string $name, array|string $content): static;

    /**
     * Add many meta tags.
     *
     * @return $this
     */
    public function addMany(array $metas): static;

    /**
     * Remove a meta from the meta collection by key.
     *
     * @return $this
     */
    public function remove(array|string $names): static;
}

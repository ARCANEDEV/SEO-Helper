<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Webmasters
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Webmasters extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Webmaster instance.
     *
     * @return $this
     */
    public static function make(array $webmasters = []): static;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get all the metas' collection.
     */
    public function all(): MetaCollection;

    /**
     * Add a webmaster to collection.
     *
     * @return $this
     */
    public function add(string $webmaster, string $content): static;

    /**
     * Reset the webmaster collection.
     *
     * @return $this
     */
    public function reset(): static;
}

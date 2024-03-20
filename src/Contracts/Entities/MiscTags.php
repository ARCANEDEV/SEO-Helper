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
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     *
     * @return $this
     */
    public static function make(array $defaults = []): static;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the current URL.
     */
    public function getUrl(): string;

    /**
     * Set the current URL.
     *
     * @return $this
     */
    public function setUrl(string $url): static;

    /**
     * Get all the metas' collection.
     */
    public function all(): MetaCollection;

    /**
     * Add a meta tag.
     *
     * @return $this
     */
    public function add(string $name, string $content): static;

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

    /**
     * Reset the meta collection.
     *
     * @return $this
     */
    public function reset(): static;
}

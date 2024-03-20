<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Keywords
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Keywords extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Keywords instance.
     *
     * @return $this
     */
    public static function make(array|string $keywords): static;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get content.
     */
    public function getContent(): array;

    /**
     * Get the keywords content.
     */
    public function get(): string;

    /**
     * Set description content.
     *
     * @return $this
     */
    public function set(array|string $content): static;

    /**
     * Add a keyword to the content.
     *
     * @return $this
     */
    public function add(string $keyword): static;

    /**
     * Add many keywords to the content.
     *
     * @return $this
     */
    public function addMany(array $keywords): static;
}

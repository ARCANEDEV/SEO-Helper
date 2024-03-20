<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Description
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Description extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a description instance.
     *
     * @return $this
     */
    public static function make(string $content, int $max = 155): static;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the raw description content.
     */
    public function getContent(): string;

    /**
     * Get the description content.
     */
    public function get(): string;

    /**
     * Set the description content.
     *
     * @return $this
     */
    public function set(string $content): static;

    /**
     * Get the description max length.
     */
    public function getMax(): int;

    /**
     * Set the description max length.
     *
     * @return $this
     */
    public function setMax(int $max): static;
}

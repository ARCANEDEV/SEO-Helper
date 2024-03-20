<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Helpers;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Meta
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Meta extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     *
     * @return $this
     */
    public static function make(string $name, array|string $content, string $propertyName = 'name', string $prefix = ''): static;

    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the meta name.
     */
    public function key(): string;

    /**
     * Set the meta prefix name.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static;

    /**
     * Set the meta property name.
     *
     * @return $this
     */
    public function setNameProperty(string $nameProperty): static;

    /**
     * Check if meta is valid.
     */
    public function isValid(): bool;
}

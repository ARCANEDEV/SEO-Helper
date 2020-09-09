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
     |  Getters and Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the meta name.
     *
     * @return string
     */
    public function key();

    /**
     * Set the meta prefix name.
     *
     * @param  string  $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix);

    /**
     * Set the meta property name.
     *
     * @param  string  $nameProperty
     *
     * @return $this
     */
    public function setNameProperty($nameProperty);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     *
     * @param  string        $name
     * @param  string|array  $content
     * @param  string        $propertyName
     * @param  string        $prefix
     *
     * @return $this
     */
    public static function make($name, $content, $propertyName = 'name', $prefix = '');

    /**
     * Check if meta is valid.
     *
     * @return bool
     */
    public function isValid();
}

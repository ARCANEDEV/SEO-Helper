<?php namespace Arcanedev\SeoHelper\Contracts\Helpers;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Meta
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Meta extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
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
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Set the meta property name.
     *
     * @param  string  $nameProperty
     *
     * @return self
     */
    public function setNameProperty($nameProperty);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Meta instance.
     *
     * @param  string  $name
     * @param  string  $content
     * @param  string  $propertyName
     * @param  string  $prefix
     *
     * @return self
     */
    public static function make($name, $content, $propertyName = 'name', $prefix = '');

    /**
     * Check if meta is valid.
     *
     * @return bool
     */
    public function isValid();
}

<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Keywords
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Keywords extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return array
     */
    public function getContent();

    /**
     * Set description content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function set($content);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Keywords instance.
     *
     * @param  array|string  $keywords
     *
     * @return self
     */
    public static function make($keywords);

    /**
     * Add a keyword to the content.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function add($keyword);

    /**
     * Add many keywords to the content.
     *
     * @param  array  $keywords
     *
     * @return self
     */
    public function addMany(array $keywords);
}

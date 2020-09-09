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
     |  Getters & Setters
     | -----------------------------------------------------------------
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
     * @return $this
     */
    public function set($content);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Keywords instance.
     *
     * @param  array|string  $keywords
     *
     * @return $this
     */
    public static function make($keywords);

    /**
     * Add a keyword to the content.
     *
     * @param  string  $keyword
     *
     * @return $this
     */
    public function add($keyword);

    /**
     * Add many keywords to the content.
     *
     * @param  array  $keywords
     *
     * @return $this
     */
    public function addMany(array $keywords);
}

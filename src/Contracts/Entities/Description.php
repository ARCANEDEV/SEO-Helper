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
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get raw description content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Get description content.
     *
     * @return string
     */
    public function get();

    /**
     * Set description content.
     *
     * @param  string  $content
     *
     * @return $this
     */
    public function set($content);

    /**
     * Get description max length.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set description max length.
     *
     * @param  int  $max
     *
     * @return $this
     */
    public function setMax($max);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a description instance.
     *
     * @param  string  $content
     * @param  int     $max
     *
     * @return $this
     */
    public static function make($content, $max = 155);
}

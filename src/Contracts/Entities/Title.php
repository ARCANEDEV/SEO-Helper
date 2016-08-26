<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Title
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Title extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get title only (without site name or separator).
     *
     * @return string
     */
    public function getTitleOnly();

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function set($title);

    /**
     * Get site name.
     *
     * @return string
     */
    public function getSiteName();

    /**
     * Set site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Get title separator.
     *
     * @return string
     */
    public function getSeparator();

    /**
     * Set title separator.
     *
     * @param  string  $separator
     *
     * @return self
     */
    public function setSeparator($separator);

    /**
     * Set title first.
     *
     * @return self
     */
    public function setFirst();

    /**
     * Set title last.
     *
     * @return self
     */
    public function setLast();

    /**
     * Check if title is first.
     *
     * @return bool
     */
    public function isTitleFirst();

    /**
     * Get title max lenght.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set title max lenght.
     *
     * @param  int  $max
     *
     * @return self
     */
    public function setMax($max);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a Title instance.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public static function make($title, $siteName = '', $separator = '-');
}

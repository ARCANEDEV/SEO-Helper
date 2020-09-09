<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Title
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Title extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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
     * @return $this
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
     * @return $this
     */
    public function setSiteName($siteName);

    /**
     * Hide the site name.
     *
     * @return $this
     */
    public function hideSiteName();

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName();

    /**
     * Set the site name visibility.
     *
     * @param  bool  $visible
     *
     * @return $this
     */
    public function setSiteNameVisibility($visible);

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
     * @return $this
     */
    public function setSeparator($separator);

    /**
     * Set title first.
     *
     * @return $this
     */
    public function setFirst();

    /**
     * Set title last.
     *
     * @return $this
     */
    public function setLast();

    /**
     * Check if title is first.
     *
     * @return bool
     */
    public function isTitleFirst();

    /**
     * Get title max length.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set title max length.
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
     * Make a Title instance.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return $this
     */
    public static function make($title, $siteName = '', $separator = '-');
}

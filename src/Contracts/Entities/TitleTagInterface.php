<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

/**
 * Interface  TitleTagInterface
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TitleTagInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render();
}

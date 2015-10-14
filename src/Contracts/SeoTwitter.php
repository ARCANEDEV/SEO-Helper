<?php namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  SeoTwitter
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoTwitter extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set the card site.
     *
     * @param  string  $site
     *
     * @return self
     */
    public function setSite($site);

    /**
     * Set the card title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function addImage($url);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Reset the twitter card.
     *
     * @return self
     */
    public function reset();
}

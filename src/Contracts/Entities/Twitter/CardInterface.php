<?php namespace Arcanedev\SeoHelper\Contracts\Entities\Twitter;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  CardInterface
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities\Twitter
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface CardInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Set card site.
     *
     * @param  string  $site
     *
     * @return self
     */
    public function setSite($site);

    /**
     * Set card title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Set card description.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function addImage($url);

    /**
     * Add a meta to the card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Reset the card.
     *
     * @return self
     */
    public function reset();
}

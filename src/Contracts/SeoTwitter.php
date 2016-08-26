<?php namespace Arcanedev\SeoHelper\Contracts;

use \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;

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
     * Set the twitter card instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard  $card
     *
     * @return self
     */
    public function setCard(CardContract $card);

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
     * Set the card description.
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
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Add a meta to the twitter card.
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
     * Reset the twitter card.
     *
     * @return self
     */
    public function reset();

    /**
     * Enable the Twitter Card.
     *
     * @return self
     */
    public function enable();

    /**
     * Disable the Twitter Card.
     *
     * @return self
     */
    public function disable();

    /* ------------------------------------------------------------------------------------------------
     |  Check Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the Twitter Card is enabled.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Check if the Twitter Card is disabled.
     *
     * @return bool
     */
    public function isDisabled();
}

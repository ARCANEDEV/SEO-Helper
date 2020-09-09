<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;

/**
 * Interface  SeoTwitter
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoTwitter extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Set the twitter card instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard  $card
     *
     * @return $this
     */
    public function setCard(CardContract $card);

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * Set the card site.
     *
     * @param  string  $site
     *
     * @return $this
     */
    public function setSite($site);

    /**
     * Set the card title.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set the card description.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function addImage($url);

    /**
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMetas(array $metas);

    /**
     * Add a meta to the twitter card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function addMeta($name, $content);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Reset the twitter card.
     *
     * @return $this
     */
    public function reset();

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enable();

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disable();

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
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

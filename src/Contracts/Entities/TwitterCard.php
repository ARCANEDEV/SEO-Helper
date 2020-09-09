<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  TwitterCard
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TwitterCard extends Renderable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const TYPE_APP                 = 'app';
    const TYPE_GALLERY             = 'gallery';
    const TYPE_PHOTO               = 'photo';
    const TYPE_PLAYER              = 'player';
    const TYPE_PRODUCT             = 'product';
    const TYPE_SUMMARY             = 'summary';
    const TYPE_SUMMARY_LARGE_IMAGE = 'summary_large_image';

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * Set card site.
     *
     * @param  string  $site
     *
     * @return $this
     */
    public function setSite($site);

    /**
     * Set card title.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set card description.
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
     * Add a meta to the card.
     *
     * @param  string        $name
     * @param  string|array  $content
     *
     * @return $this
     */
    public function addMeta($name, $content);

    /**
     * Get all supported card types.
     *
     * @return array
     */
    public function types();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Reset the card.
     *
     * @return $this
     */
    public function reset();
}

<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  TwitterCard
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities\Twitter
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TwitterCard extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const TYPE_APP                 = 'app';
    const TYPE_GALLERY             = 'gallery';
    const TYPE_PHOTO               = 'photo';
    const TYPE_PLAYER              = 'player';
    const TYPE_PRODUCT             = 'product';
    const TYPE_SUMMARY             = 'summary';
    const TYPE_SUMMARY_LARGE_IMAGE = 'summary_large_image';

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
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Add a meta to the card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content);

    /**
     * Get all supported card types.
     *
     * @return array
     */
    public function types();

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

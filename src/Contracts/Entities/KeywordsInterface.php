<?php namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  KeywordsInterface
 *
 * @package   Arcanedev\SeoHelper\Contracts\Entities
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface KeywordsInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return array
     */
    public function getContent();

    /**
     * Set description content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function setContent($content);
}

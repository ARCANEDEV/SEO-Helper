<?php namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  SeoHelper
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoHelper extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get SeoMeta instance.
     *
     * @return SeoMeta
     */
    public function meta();

    /**
     * Get SeoTwitter instance.
     *
     * @return SeoOpenGraph
     */
    public function openGraph();

    /**
     * Get SeoTwitter instance (alias).
     *
     * @return SeoOpenGraph
     */
    public function og();

    /**
     * Get SeoTwitter instance.
     *
     * @return SeoTwitter
     */
    public function twitter();
}

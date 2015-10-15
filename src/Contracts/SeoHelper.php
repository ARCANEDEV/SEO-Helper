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
     * Set SeoMeta instance.
     *
     * @param  SeoMeta  $seoMeta
     *
     * @return self
     */
    public function setSeoMeta(SeoMeta $seoMeta);

    /**
     * Get SeoOpenGraph instance.
     *
     * @return SeoOpenGraph
     */
    public function openGraph();

    /**
     * Get SeoOpenGraph instance (alias).
     *
     * @see    \Arcanedev\SeoHelper\SeoHelper::openGraph()
     *
     * @return SeoOpenGraph
     */
    public function og();

    /**
     * Get SeoOpenGraph instance.
     *
     * @param  SeoOpenGraph  $seoOpenGraph
     *
     * @return self
     */
    public function setSeoOpenGraph(SeoOpenGraph $seoOpenGraph);

    /**
     * Get SeoTwitter instance.
     *
     * @return SeoTwitter
     */
    public function twitter();

    /**
     * Set SeoTwitter instance.
     *
     * @param  SeoTwitter  $seoTwitter
     *
     * @return self
     */
    public function setSeoTwitter(SeoTwitter $seoTwitter);
}

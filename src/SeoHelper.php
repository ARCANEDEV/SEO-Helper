<?php namespace Arcanedev\SeoHelper;

/**
 * Class     SeoHelper
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelper implements Contracts\SeoHelper
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The SeoMeta instance.
     *
     * @var Contracts\SeoMeta
     */
    private $seoMeta;

    /**
     * The SeoOpenGraph instance.
     *
     * @var Contracts\SeoOpenGraph
     */
    private $seoOpenGraph;

    /**
     * The SeoTwitter instance.
     *
     * @var Contracts\SeoTwitter
     */
    private $seoTwitter;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoHelper instance.
     *
     * @param  Contracts\SeoMeta       $seoMeta
     * @param  Contracts\SeoOpenGraph  $seoOpenGraph
     * @param  Contracts\SeoTwitter    $seoTwitter
     */
    public function __construct(
        Contracts\SeoMeta      $seoMeta,
        Contracts\SeoOpenGraph $seoOpenGraph,
        Contracts\SeoTwitter   $seoTwitter
    ) {
        $this->seoMeta      = $seoMeta;
        $this->seoOpenGraph = $seoOpenGraph;
        $this->seoTwitter   = $seoTwitter;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get SeoMeta instance.
     *
     * @return Contracts\SeoMeta
     */
    public function meta()
    {
        return $this->seoMeta;
    }

    /**
     * Get SeoTwitter instance.
     *
     * @return Contracts\SeoTwitter
     */
    public function openGraph()
    {
        return $this->seoOpenGraph;
    }

    /**
     * Get SeoTwitter instance (alias).
     *
     * @see    \Arcanedev\SeoHelper\SeoHelper::openGraph()
     *
     * @return Contracts\SeoTwitter
     */
    public function og()
    {
        return $this->openGraph();
    }

    /**
     * Get SeoTwitter instance.
     *
     * @return Contracts\SeoTwitter
     */
    public function twitter()
    {
        return $this->seoTwitter;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, [
            $this->meta()->render(),
            $this->og()->render(),
            $this->twitter()->render(),
        ]);
    }
}

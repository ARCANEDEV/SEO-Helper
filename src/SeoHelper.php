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

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoHelper instance.
     *
     * @param  Contracts\SeoMeta  $seoMeta
     */
    public function __construct(Contracts\SeoMeta $seoMeta)
    {
        $this->seoMeta = $seoMeta;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
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
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, [
            $this->meta()->render(),
        ]);
    }
}

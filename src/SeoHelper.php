<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaInterface;

/**
 * Class     SeoHelper
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelper
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The SeoMeta instance.
     *
     * @var SeoMetaInterface
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
    public function __construct(SeoMetaInterface $seoMeta)
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
}

<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoMetaInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Config\Repository as Config;

/**
 * Class     SeoMeta
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMeta implements SeoMetaInterface, Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Illuminate Config repository.
     *
     * @var Config
     */
    private $config;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoMeta instance.
     *
     * @param  Config  $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        //
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
}

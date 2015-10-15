<?php namespace Arcanedev\SeoHelper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class     SeoOpenGraph
 *
 * @package  Arcanedev\SeoHelper\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraph extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.seo-helper.open-graph'; }
}

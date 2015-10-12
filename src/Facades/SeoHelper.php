<?php namespace Arcanedev\SeoHelper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class     SeoHelper
 *
 * @package  Arcanedev\SeoHelper\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.seo-helper'; }
}

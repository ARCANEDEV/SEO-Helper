<?php namespace Arcanedev\SeoHelper\Facades;

use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
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
    protected static function getFacadeAccessor() { return SeoOpenGraphContract::class; }
}

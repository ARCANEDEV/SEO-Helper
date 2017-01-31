<?php namespace Arcanedev\SeoHelper\Facades;

use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     SeoTwitter
 *
 * @package  Arcanedev\SeoHelper\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoTwitter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return SeoTwitterContract::class; }
}

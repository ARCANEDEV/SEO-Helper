<?php namespace Arcanedev\SeoHelper;

use Arcanedev\Support\PackageServiceProvider as ServiceProvider;

/**
 * Class     SeoHelperServiceProvider
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor   = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package  = 'seo-helper';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer    = true;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
        $this->app->register(Providers\UtilityServiceProvider::class);
        $this->registerSeoHelperService();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        // Publish the config file.
        $this->publishes([
            $this->getConfigFile() => config_path("{$this->package}.php"),
        ], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.seo-helper',
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,

            // Utilities
            'arcanedev.seo-helper.meta',
            'arcanedev.seo-helper.open-graph',
            'arcanedev.seo-helper.twitter',
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Services Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register SeoMeta service.
     */
    private function registerSeoHelperService()
    {
        $this->singleton(
            'arcanedev.seo-helper',
            \Arcanedev\SeoHelper\SeoHelper::class
        );

        $this->app->bind(
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,
            'arcanedev.seo-helper'
        );
    }
}

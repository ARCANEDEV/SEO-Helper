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
    protected $vendor  = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'seo-helper';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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

        $this->registerSeoMetaService();
        $this->registerSeoHelperService();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();
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
            'arcanedev.seo-helper.meta',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Services Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register SeoMeta service.
     */
    private function registerSeoMetaService()
    {
        $this->singleton('arcanedev.seo-helper.meta', function ($app) {
            /** @var  \Illuminate\Config\Repository  $config */
            $config = $app['config'];

            return new SeoMeta($config->get('seo-helper'));
        });

        $this->app->bind(Contracts\SeoMeta::class, 'arcanedev.seo-helper.meta');
    }

    /**
     * Register SeoMeta service.
     */
    private function registerSeoHelperService()
    {
        $this->singleton('arcanedev.seo-helper', function ($app) {
            /** @var Contracts\SeoMeta $seoMeta */
            $seoMeta = $app['arcanedev.seo-helper.meta'];

            return new SeoHelper($seoMeta);
        });
    }
}

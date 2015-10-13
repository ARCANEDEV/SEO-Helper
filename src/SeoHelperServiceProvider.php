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

        $this->registerSeoMetaService();
        $this->registerSeoOpenGraphService();
        $this->registerSeoTwitterService();
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
            'arcanedev.seo-helper.meta',
            'arcanedev.seo-helper.open-graph',
            'arcanedev.seo-helper.twitter',
            Contracts\SeoHelper::class,
            Contracts\SeoMeta::class,
            Contracts\SeoOpenGraph::class,
            Contracts\SeoTwitter::class,
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
     * Register SeoOpenGraph service.
     */
    private function registerSeoOpenGraphService()
    {
        $this->singleton('arcanedev.seo-helper.open-graph', function ($app) {
            /** @var  \Illuminate\Config\Repository  $config */
            $config = $app['config'];

            return new SeoOpenGraph($config->get('seo-helper'));
        });

        $this->app->bind(Contracts\SeoOpenGraph::class, 'arcanedev.seo-helper.open-graph');
    }

    /**
     * Register SeoTwitter service.
     */
    private function registerSeoTwitterService()
    {
        $this->singleton('arcanedev.seo-helper.twitter', function ($app) {
            /** @var  \Illuminate\Config\Repository  $config */
            $config = $app['config'];

            return new SeoTwitter($config->get('seo-helper'));
        });

        $this->app->bind(Contracts\SeoTwitter::class, 'arcanedev.seo-helper.twitter');
    }

    /**
     * Register SeoMeta service.
     */
    private function registerSeoHelperService()
    {
        $this->singleton('arcanedev.seo-helper', function ($app) {
            /**
             * @var  Contracts\SeoMeta       $seoMeta
             * @var  Contracts\SeoOpenGraph  $seoOpenGraph
             * @var  Contracts\SeoTwitter    $seoTwitter
             */
            $seoMeta      = $app['arcanedev.seo-helper.meta'];
            $seoOpenGraph = $app['arcanedev.seo-helper.open-graph'];
            $seoTwitter   = $app['arcanedev.seo-helper.twitter'];

            return new SeoHelper($seoMeta, $seoOpenGraph, $seoTwitter);
        });

        $this->app->bind(Contracts\SeoHelper::class, 'arcanedev.seo-helper');
    }
}

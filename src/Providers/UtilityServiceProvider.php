<?php namespace Arcanedev\SeoHelper\Providers;

use Arcanedev\SeoHelper\SeoMeta;
use Arcanedev\SeoHelper\SeoOpenGraph;
use Arcanedev\SeoHelper\SeoTwitter;
use Arcanedev\Support\ServiceProvider;

/**
 * Class     UtilityServiceProvider
 *
 * @package  Arcanedev\SeoHelper\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UtilityServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSeoMetaService();
        $this->registerSeoOpenGraphService();
        $this->registerSeoTwitterService();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
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
    private function registerSeoMetaService()
    {
        $this->singleton('arcanedev.seo-helper.meta', function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoMeta($config->get('seo-helper'));
        });

        $this->bind(
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            'arcanedev.seo-helper.meta'
        );
    }

    /**
     * Register SeoOpenGraph service.
     */
    private function registerSeoOpenGraphService()
    {
        $this->singleton('arcanedev.seo-helper.open-graph', function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoOpenGraph($config->get('seo-helper'));
        });

        $this->bind(
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            'arcanedev.seo-helper.open-graph'
        );
    }

    /**
     * Register SeoTwitter service.
     */
    private function registerSeoTwitterService()
    {
        $this->singleton('arcanedev.seo-helper.twitter', function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoTwitter($config->get('seo-helper'));
        });

        $this->bind(
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
            'arcanedev.seo-helper.twitter'
        );
    }
}

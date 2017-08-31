<?php namespace Arcanedev\SeoHelper\Providers;

use Arcanedev\SeoHelper\Contracts;
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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

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
            Contracts\SeoMeta::class,
            Contracts\SeoOpenGraph::class,
            Contracts\SeoTwitter::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Utilities
     | -----------------------------------------------------------------
     */

    /**
     * Register SeoMeta service.
     */
    private function registerSeoMetaService()
    {
        $this->singleton(Contracts\SeoMeta::class, function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoMeta($config->get('seo-helper'));
        });
    }

    /**
     * Register SeoOpenGraph service.
     */
    private function registerSeoOpenGraphService()
    {
        $this->singleton(Contracts\SeoOpenGraph::class, function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoOpenGraph($config->get('seo-helper'));
        });
    }

    /**
     * Register SeoTwitter service.
     */
    private function registerSeoTwitterService()
    {
        $this->singleton(Contracts\SeoTwitter::class, function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new SeoTwitter($config->get('seo-helper'));
        });
    }
}

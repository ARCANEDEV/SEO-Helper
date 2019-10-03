<?php namespace Arcanedev\SeoHelper;

use Arcanedev\Support\Providers\PackageServiceProvider as ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     SeoHelperServiceProvider
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'seo-helper';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->registerConfig();

        $this->registerSeoHelperService();
        $this->registerSeoMetaService();
        $this->registerSeoOpenGraphService();
        $this->registerSeoTwitterService();
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishConfig();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\SeoHelper::class,
            Contracts\SeoMeta::class,
            Contracts\SeoOpenGraph::class,
            Contracts\SeoTwitter::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Register SeoHelper service.
     */
    private function registerSeoHelperService(): void
    {
        $this->singleton(Contracts\SeoHelper::class, SeoHelper::class);
    }

    /**
     * Register SeoMeta service.
     */
    private function registerSeoMetaService(): void
    {
        $this->singleton(Contracts\SeoMeta::class, function ($app) {
            return new SeoMeta($app['config']->get('seo-helper'));
        });
    }

    /**
     * Register SeoOpenGraph service.
     */
    private function registerSeoOpenGraphService(): void
    {
        $this->singleton(Contracts\SeoOpenGraph::class, function ($app) {
            return new SeoOpenGraph($app['config']->get('seo-helper'));
        });
    }

    /**
     * Register SeoTwitter service.
     */
    private function registerSeoTwitterService(): void
    {
        $this->singleton(Contracts\SeoTwitter::class, function ($app) {
            return new SeoTwitter($app['config']->get('seo-helper'));
        });
    }
}

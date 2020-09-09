<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoHelper as SeoHelperContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Arcanedev\Support\Providers\PackageServiceProvider as ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     SeoHelperServiceProvider
 *
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
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            SeoHelperContract::class,
            SeoMetaContract::class,
            SeoOpenGraphContract::class,
            SeoTwitterContract::class,
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
        $this->singleton(SeoHelperContract::class, SeoHelper::class);
    }

    /**
     * Register SeoMeta service.
     */
    private function registerSeoMetaService(): void
    {
        $this->singleton(SeoMetaContract::class, function ($app) {
            return new SeoMeta($app['config']->get('seo-helper'));
        });
    }

    /**
     * Register SeoOpenGraph service.
     */
    private function registerSeoOpenGraphService(): void
    {
        $this->singleton(SeoOpenGraphContract::class, function ($app) {
            return new SeoOpenGraph($app['config']->get('seo-helper'));
        });
    }

    /**
     * Register SeoTwitter service.
     */
    private function registerSeoTwitterService(): void
    {
        $this->singleton(SeoTwitterContract::class, function ($app) {
            return new SeoTwitter($app['config']->get('seo-helper'));
        });
    }
}

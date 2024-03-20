<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Asserts\AssertsHtmlStrings;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->app->loadDeferredProviders();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Arcanedev\SeoHelper\SeoHelperServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        /** @var  \Illuminate\Contracts\Config\Repository  $config */
        $config = $app['config'];

        // Keywords
        $config->set('seo-helper.keywords', [
            'default'   => [
                'keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'
            ],
        ]);

        // Webmasters
        $config->set('seo-helper.webmasters', [
            'google'    => 'site-verification-code',
            'bing'      => 'site-verification-code',
            'alexa'     => 'site-verification-code',
            'pinterest' => 'site-verification-code',
            'yandex'    => 'site-verification-code',
        ]);

        // Analytics
        $config->set('seo-helper.analytics', [
            'google'    => 'UA-12345678-9',
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get SeoHelper config.
     */
    protected function getSeoHelperConfig(?string $name = null, mixed $default = null): mixed
    {
        $config = $this->app['config'];

        return $name === null
            ? $config->get('seo-helper', [])
            : $config->get("seo-helper.{$name}", $default);
    }
}

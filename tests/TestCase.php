<?php namespace Arcanedev\SeoHelper\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\SeoHelper\Tests
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

    public function setUp()
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
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\SeoHelper\SeoHelperServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            //
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Keywords
        $app['config']->set('seo-helper.keywords', [
            'default'   => [
                'keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'
            ],
        ]);

        // Webmasters
        $app['config']->set('seo-helper.webmasters', [
            'google'    => 'site-verification-code',
            'bing'      => 'site-verification-code',
            'alexa'     => 'site-verification-code',
            'pinterest' => 'site-verification-code',
            'yandex'    => 'site-verification-code',
        ]);

        // Analytics
        $app['config']->set('seo-helper.analytics', [
            'google'    => 'UA-12345678-9',
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get Config instance.
     *
     * @return \Illuminate\Config\Repository
     */
    protected function config()
    {
        return $this->app['config'];
    }

    /**
     * Get SeoHelper config.
     *
     * @param  string      $name
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getSeoHelperConfig($name = null, $default = null)
    {
        return is_null($name)
            ? $this->config()->get('seo-helper', [])
            : $this->config()->get("seo-helper.$name", $default);
    }
}

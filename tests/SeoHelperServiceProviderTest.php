<?php namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\SeoHelperServiceProvider;

/**
 * Class     SeoHelperServiceProviderTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoHelperServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(SeoHelperServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_get_service_provider()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\SeoHelper\SeoHelperServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_get_provides()
    {
        $expected = [
            'arcanedev.seo-helper',
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,

            // Utilities
            'arcanedev.seo-helper.meta',
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            'arcanedev.seo-helper.open-graph',
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            'arcanedev.seo-helper.twitter',
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}

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
        parent::tearDown();

        unset($this->provider);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_get_service_provider()
    {
        $this->assertInstanceOf(\Illuminate\Support\ServiceProvider::class, $this->provider);
        $this->assertInstanceOf(\Arcanedev\Support\ServiceProvider::class, $this->provider);
        $this->assertInstanceOf(\Arcanedev\Support\PackageServiceProvider::class, $this->provider);
    }

    /** @test */
    public function it_can_get_provides()
    {
        $this->assertEquals([], $this->provider->provides());
    }
}

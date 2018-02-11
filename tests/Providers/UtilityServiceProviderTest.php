<?php namespace Arcanedev\SeoHelper\Tests\Providers;

use Arcanedev\SeoHelper\Providers\UtilityServiceProvider;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     UtilityServiceProviderTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UtilityServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Providers\UtilityServiceProvider */
    private $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(UtilityServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Providers\UtilityServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Illuminate\Support\ServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
        ];

        static::assertSame($expected, $this->provider->provides());
    }
}

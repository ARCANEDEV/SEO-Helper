<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\Contracts\{SeoHelper, SeoMeta, SeoOpenGraph, SeoTwitter};
use Arcanedev\SeoHelper\SeoHelperServiceProvider;
use Arcanedev\Support\Providers\{PackageServiceProvider, ServiceProvider};
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class     SeoHelperServiceProviderTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private ?SeoHelperServiceProvider $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(SeoHelperServiceProvider::class);
    }

    public function tearDown(): void
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_get_service_provider(): void
    {
        $expectations = [
            IlluminateServiceProvider::class,
            DeferrableProvider::class,
            ServiceProvider::class,
            PackageServiceProvider::class,
            SeoHelperServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides(): void
    {
        $expected = [
            SeoHelper::class,
            SeoMeta::class,
            SeoOpenGraph::class,
            SeoTwitter::class,
        ];

        static::assertSame($expected, $this->provider->provides());
    }
}

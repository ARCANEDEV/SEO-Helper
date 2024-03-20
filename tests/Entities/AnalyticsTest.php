<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\Analytics;
use Arcanedev\SeoHelper\Tests\TestCase;
use Arcanedev\SeoHelper\Tests\Traits\CanAssertsGoogleAnalytics;

/**
 * Class     AnalyticsTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AnalyticsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanAssertsGoogleAnalytics;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private AnalyticsContract $analytics;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->analytics = new Analytics(
            $this->getSeoHelperConfig('analytics', [])
        );
    }

    public function tearDown(): void
    {
        unset($this->analytics);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            Renderable::class,
            AnalyticsContract::class,
            Analytics::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->analytics);
        }
    }

    /** @test */
    public function it_must_render_empty_on_init(): void
    {
        $this->analytics = new Analytics();

        static::assertEmpty($this->analytics->render());
    }

    /** @test */
    public function it_can_render(): void
    {
        static::assertGoogleAnalytics('UA-12345678-9', $this->analytics->render());
        static::assertGoogleAnalytics('UA-12345678-9', (string) $this->analytics);
    }
}

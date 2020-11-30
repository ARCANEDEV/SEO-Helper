<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

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

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\Analytics */
    private $analytics;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $config          = $this->getSeoHelperConfig('analytics', []);
        $this->analytics = new Analytics($config);
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
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\Contracts\Entities\Analytics::class,
            \Arcanedev\SeoHelper\Entities\Analytics::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->analytics);
        }
    }

    /** @test */
    public function it_must_render_empty_on_init(): void
    {
        $this->analytics = new Analytics;

        static::assertEmpty($this->analytics->render());
    }

    /** @test */
    public function it_can_render(): void
    {
        static::assertGoogleAnalytics('UA-12345678-9', $this->analytics->render());
        static::assertGoogleAnalytics('UA-12345678-9', (string) $this->analytics);
    }
}

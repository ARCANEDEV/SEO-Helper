<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Analytics;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     AnalyticsTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AnalyticsTest extends TestCase
{
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
    public function it_can_be_instantiated()
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
    public function it_must_render_empty_on_init()
    {
        $this->analytics = new Analytics;

        static::assertEmpty($this->analytics->render());
    }

    /** @test */
    public function it_can_render()
    {
        $expectations = [
            '<script>',
                "ga('create', 'UA-12345678-9', 'auto');",
            '</script>',
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->analytics->render());
            static::assertStringContainsString($expected, (string) $this->analytics);
        }
    }
}

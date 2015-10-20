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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Analytics */
    private $analytics;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config          = $this->getSeoHelperConfig('analytics', []);
        $this->analytics = new Analytics($config);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->analytics);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Entities\Analytics::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->analytics);
        }
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
            $this->assertContains($expected, $this->analytics->render());
            $this->assertContains($expected, (string) $this->analytics);
        }
    }
}

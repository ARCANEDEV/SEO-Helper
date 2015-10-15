<?php namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\SeoOpenGraph;

/**
 * Class     SeoOpenGraphTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraphTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoOpenGraph */
    private $seoOpenGraph;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs            = $this->getSeoHelperConfig();
        $this->seoOpenGraph = new SeoOpenGraph($configs);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->seoOpenGraph);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->seoOpenGraph);
        }
    }
}

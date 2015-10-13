<?php namespace Arcanedev\SeoHelper\Tests;
use Arcanedev\SeoHelper\SeoTwitter;

/**
 * Class     SeoTwitterTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoTwitterTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoTwitter */
    private $seoTwitter;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs          = $this->getSeoHelperConfig();
        $this->seoTwitter = new SeoTwitter($configs);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->seoTwitter);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Bases\Seo::class,
            \Arcanedev\SeoHelper\SeoTwitter::class
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->seoTwitter);
        }
    }
}

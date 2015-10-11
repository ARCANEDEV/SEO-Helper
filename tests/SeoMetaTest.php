<?php namespace Arcanedev\SeoHelper\Tests;
use Arcanedev\SeoHelper\SeoMeta;

/**
 * Class     SeoMetaTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMetaTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoMeta */
    private $seoMeta;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoMeta = new SeoMeta($this->app['config']);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->seoMeta);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(SeoMeta::class, $this->seoMeta);
    }
}

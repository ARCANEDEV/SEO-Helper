<?php namespace Arcanedev\SeoHelper\Tests;
use Arcanedev\SeoHelper\SeoHelper;

/**
 * Class     SeoHelperTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoHelper */
    private $seoHelper;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoHelper = $this->app['arcanedev.seo-helper'];
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->seoHelper);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(SeoHelper::class, $this->seoHelper);
    }

    /** @test */
    public function it_can_get_seo_meta()
    {
        $seoMeta = $this->seoHelper->meta();

        $this->assertInstanceOf(\Arcanedev\SeoHelper\SeoMeta::class,           $seoMeta);
        $this->assertInstanceOf(\Arcanedev\SeoHelper\Contracts\SeoMeta::class, $seoMeta);
    }
}

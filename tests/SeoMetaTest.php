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
        $this->assertNotEmpty($this->seoMeta->render());
    }

    /** @test */
    public function it_can_set_and_get_and_render_title()
    {
        $title = 'Awesome Title';

        $this->seoMeta->setTitle($title);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            '<title>' . $title . '</title>',
            $this->seoMeta->renderTitle()
        );

        $siteName = 'Company name';
        $this->seoMeta->setTitle($title, $siteName);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            '<title>' . $title . ' - ' . $siteName . '</title>',
            $this->seoMeta->renderTitle()
        );

        $separator = '|';
        $this->seoMeta->setTitle($title, $siteName, $separator);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            "<title>$title $separator $siteName</title>",
            $this->seoMeta->renderTitle()
        );
    }
}

<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\TitleTag;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     TitleTagTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TitleTagTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var TitleTag */
    protected $title;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config    = $this->getTitleConfig();
        $this->title = new TitleTag($config);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(TitleTag::class, $this->title);
    }

    /** @test */
    public function it_can_get_default_title()
    {
        $this->assertEquals(
            $this->getDefaultTitle(), $this->title->getTitle()
        );
    }

    /** @test */
    public function it_can_set_and_get_title()
    {
        $title = 'Awesome Title';

        $this->title->setTitle($title);

        $this->assertEquals($title, $this->title->getTitle());
    }

    /** @test */
    public function it_can_get_default_site_name()
    {
        $this->assertEquals(
            $this->getDefaultSiteName(),
            $this->title->getSiteName()
        );
    }

    /** @test */
    public function it_can_set_and_get_site_name()
    {
        $siteName = 'Company name';

        $this->title->setSiteName($siteName);

        $this->assertEquals($siteName, $this->title->getSiteName());
    }

    /** @test */
    public function it_can_get_default_separator()
    {
        $this->assertEquals(
            $this->getDefaultSeparator(), $this->title->getSeparator()
        );
    }

    /** @test */
    public function it_can_get_and_set_separator()
    {
        $separator = '|';
        $this->title->setSeparator($separator);

        $this->assertEquals($separator, $this->title->getSeparator());

        $separator = ' _ ';
        $this->title->setSeparator($separator);

        $this->assertEquals(trim($separator), $this->title->getSeparator());
    }

    /** @test */
    public function it_can_get_default_title_position()
    {
        $this->assertEquals(
            array_get($this->getTitleConfig(), 'first', true),
            $this->title->isTitleFirst()
        );
    }

    /** @test */
    public function it_can_switch_title_position()
    {
        $this->assertTrue($this->title->isTitleFirst());

        $this->title->setLast();

        $this->assertFalse($this->title->isTitleFirst());

        $this->title->setFirst();

        $this->assertTrue($this->title->isTitleFirst());
    }

    /** @test */
    public function it_can_render_default_title()
    {
        $title = $this->getDefaultTitle();

        $this->assertEquals(
            "<title>$title</title>", $this->title->render()
        );
    }

    /** @test */
    public function it_can_render_custom_titles()
    {
        $title     = 'Awesome Title';
        $siteName  = 'Company name';
        $separator = '|';

        $this->title
            ->setTitle($title)
            ->setSiteName($siteName)
            ->setSeparator($separator);

        $this->assertEquals("<title>$title $separator $siteName</title>", $this->title->render());

        $this->title->setLast();

        $this->assertEquals("<title>$siteName $separator $title</title>", $this->title->render());

        $separator = '|';
        $this->title->setSeparator($separator);

        $this->assertEquals("<title>$siteName $separator $title</title>", $this->title->render());

        $this->title->setFirst();

        $this->assertEquals("<title>$title $separator $siteName</title>", $this->title->render());

        $this->title->setSiteName('');

        $this->assertEquals("<title>$title</title>", $this->title->render());

        $this->title->setLast();

        $this->assertEquals("<title>$title</title>", $this->title->render());

        $this->title
            ->setSiteName($siteName)
            ->setSeparator('')
            ->setFirst();

        $this->assertEquals("<title>$title $siteName</title>", $this->title->render());

        $this->title->setLast();

        $this->assertEquals("<title>$siteName $title</title>", $this->title->render());
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\TitleException
     * @expectedExceptionMessage  The title must be a string value, [NULL] is given.
     */
    public function it_must_throw_title_exception_on_invalid_type()
    {
        $this->title->setTitle(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\TitleException
     * @expectedExceptionMessage  The title is required and must not be empty.
     */
    public function it_must_throw_title_exception_on_empty_title()
    {
        $this->title->setTitle('  ');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Title config.
     *
     * @return array
     */
    private function getTitleConfig()
    {
        return config('seo-helper.title', []);
    }

    /**
     * Get default title.
     *
     * @param  string  $default
     *
     * @return string
     */
    private function getDefaultTitle($default = '')
    {
        return array_get($this->getTitleConfig(), 'default', $default);
    }

    /**
     * Get default site name.
     *
     * @param  string  $default
     *
     * @return string
     */
    private function getDefaultSiteName($default = '')
    {
        return array_get($this->getTitleConfig(), 'site-name', $default);
    }

    /**
     * Get default separator.
     *
     * @param  string  $default
     *
     * @return string
     */
    private function getDefaultSeparator($default = '-')
    {
        return array_get($this->getTitleConfig(), 'separator', $default);
    }
}

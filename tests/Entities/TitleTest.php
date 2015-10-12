<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\Title;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     TitleTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TitleTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Title */
    protected $title;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config      = $this->getTitleConfig();
        $this->title = new Title($config);
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
        $this->assertInstanceOf(Title::class,      $this->title);
        $this->assertInstanceOf(Renderable::class, $this->title);
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

    /** @test */
    public function it_can_make_title_tag()
    {
        $title     = 'Awesome title';
        $siteName  = 'Company Name';
        $separator = '|';

        $this->title = Title::make($title, $siteName, $separator);

        $this->assertInstanceOf(Title::class, $this->title);

        $this->assertEquals($title,     $this->title->getTitle());
        $this->assertEquals($siteName,  $this->title->getSiteName());
        $this->assertEquals($separator, $this->title->getSeparator());

        $this->assertEquals(
            '<title>Awesome title | Company Name</title>',
            $this->title->render()
        );
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The title must be a string value, [NULL] is given.
     */
    public function it_must_throw_title_exception_on_invalid_type()
    {
        $this->title->setTitle(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The title is required and must not be empty.
     */
    public function it_must_throw_title_exception_on_empty_title()
    {
        $this->title->setTitle('  ');
    }

    /** @test */
    public function it_can_set_and_get_max_length()
    {
        $max = 50;

        $this->title->setMax($max);

        $this->assertEquals($max, $this->title->getMax());
    }

    /** @test */
    public function it_can_render_long_title()
    {
        $title = 'This is my long and awesome title that gonna blown your mind.';
        $max   = $this->getDefaultMax();

        $this->title->setTitle($title)->setMax($max);

        $this->assertEquals(
            '<title>' . str_limit($title, $max) . '</title>',
            $this->title->render()
        );
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The title maximum lenght must be integer.
     */
    public function it_must_throw_invalid_max_lenght_type()
    {
        $this->title->setMax(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The title maximum lenght must be greater 0.
     */
    public function it_must_throw_invalid_max_lenght_value()
    {
        $this->title->setMax(0);
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
        return $this->config()->get('seo-helper.title', []);
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

    /**
     * Get title max length.
     *
     * @param  int  $default
     *
     * @return int
     */
    private function getDefaultMax($default = 55)
    {
        return array_get($this->getTitleConfig(), 'max', $default);
    }
}

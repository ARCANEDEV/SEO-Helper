<?php namespace Arcanedev\SeoHelper\Tests\Entities;

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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\Title */
    protected $title;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $config      = $this->getTitleConfig();
        $this->title = new Title($config);
    }

    public function tearDown(): void
    {
        unset($this->title);

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
            \Arcanedev\SeoHelper\Contracts\Entities\Title::class,
            \Arcanedev\SeoHelper\Entities\Title::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->title);
        }
    }

    /** @test */
    public function it_can_get_default_title()
    {
        static::assertSame(
            $this->getDefaultTitle(),
            $this->title->getTitleOnly()
        );
    }

    /** @test */
    public function it_can_set_and_get_title()
    {
        $title = 'Awesome Title';

        $this->title->set($title);

        static::assertSame($title, $this->title->getTitleOnly());
    }

    /** @test */
    public function it_can_get_default_site_name()
    {
        static::assertSame(
            $this->getDefaultSiteName(),
            $this->title->getSiteName()
        );
    }

    /** @test */
    public function it_can_set_and_get_site_name()
    {
        $siteName = 'Company name';

        $this->title->setSiteName($siteName);

        static::assertSame($siteName, $this->title->getSiteName());
    }

    /** @test */
    public function it_can_get_default_separator()
    {
        static::assertSame(
            $this->getDefaultSeparator(),
            $this->title->getSeparator()
        );
    }

    /** @test */
    public function it_can_get_and_set_separator()
    {
        $separator = '|';
        $this->title->setSeparator($separator);

        static::assertSame($separator, $this->title->getSeparator());

        $separator = ' _ ';
        $this->title->setSeparator($separator);

        static::assertSame(trim($separator), $this->title->getSeparator());
    }

    /** @test */
    public function it_can_get_default_title_position()
    {
        static::assertSame(
            array_get($this->getTitleConfig(), 'first', true),
            $this->title->isTitleFirst()
        );
    }

    /** @test */
    public function it_can_switch_title_position()
    {
        static::assertTrue($this->title->isTitleFirst());

        $this->title->setLast();

        static::assertFalse($this->title->isTitleFirst());

        $this->title->setFirst();

        static::assertTrue($this->title->isTitleFirst());
    }

    /** @test */
    public function it_can_render_default_title()
    {
        $title    = $this->getDefaultTitle();
        $siteName = $this->getDefaultSiteName();
        $expected = "<title>{$title} - {$siteName}</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_render_custom_titles()
    {
        $title     = 'Awesome Title';
        $siteName  = 'Company name';
        $separator = '|';

        $this->title
            ->set($title)
            ->setSiteName($siteName)
            ->setSeparator($separator);

        $expected = "<title>$title $separator $siteName</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->setLast();
        $expected = "<title>$siteName $separator $title</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $separator = '|';
        $this->title->setSeparator($separator);
        $expected  = "<title>$siteName $separator $title</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->setFirst();
        $expected = "<title>$title $separator $siteName</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->setSiteName('');
        $expected = "<title>$title</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->setLast();
        $expected = "<title>$title</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title
            ->setSiteName($siteName)
            ->setSeparator('')
            ->setFirst();

        $expected = "<title>$title $siteName</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->setLast();
        $expected = "<title>$siteName $title</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_make_title_tag()
    {
        $title     = 'Awesome title';
        $siteName  = 'Company Name';
        $separator = '|';

        $this->title = Title::make($title, $siteName, $separator);

        static::assertInstanceOf(Title::class, $this->title);

        static::assertSame($title,     $this->title->getTitleOnly());
        static::assertSame($siteName,  $this->title->getSiteName());
        static::assertSame($separator, $this->title->getSeparator());

        $expected = '<title>Awesome title | Company Name</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_toggle_site_name_visibility()
    {
        $title     = 'Awesome title';
        $siteName  = 'Company Name';
        $separator = '|';

        $this->title = Title::make($title, $siteName, $separator);

        $expected = '<title>Awesome title | Company Name</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->hideSiteName();

        $expected = '<title>Awesome title</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());

        $this->title->showSiteName();

        $expected = '<title>Awesome title | Company Name</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_must_throw_title_exception_on_invalid_type()
    {
        $this->expectException(\Arcanedev\SeoHelper\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('The title must be a string value, [NULL] is given.');

        $this->title->set(null);
    }

    /** @test */
    public function it_must_throw_title_exception_on_empty_title()
    {
        $this->expectException(\Arcanedev\SeoHelper\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('The title is required and must not be empty.');

        $this->title->set('  ');
    }

    /** @test */
    public function it_can_set_and_get_max_length()
    {
        $this->title->setMax($max = 50);

        static::assertSame($max, $this->title->getMax());
    }

    /** @test */
    public function it_can_render_long_title()
    {
        $title = 'This is my long and awesome title that gonna blown your mind.';
        $max   = $this->getDefaultMax();

        $this->title->set($title)->setMax($max);

        $expected = '<title>'.str_limit($title, $max).'</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_render_title_with_accents()
    {
        $this->title->set('Ce package est intuitif, exceptionnel et bien sûr opérationnel');

        $expected = '<title>Ce package est intuitif, exceptionnel et bien sûr opéra...</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_must_throw_invalid_max_length_type()
    {
        $this->expectException(\Arcanedev\SeoHelper\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('The title maximum length must be integer.');

        $this->title->setMax(null);
    }

    /** @test */
    public function it_must_throw_invalid_max_length_value()
    {
        $this->expectException(\Arcanedev\SeoHelper\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('The title maximum length must be greater 0.');

        $this->title->setMax(0);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get Title config.
     *
     * @return array
     */
    private function getTitleConfig()
    {
        return $this->getSeoHelperConfig('title', []);
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
        return $this->getSeoHelperConfig('title.default', $default);
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
        return $this->getSeoHelperConfig('title.site-name', $default);
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
        return $this->getSeoHelperConfig('title.separator', $default);
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
        return $this->getSeoHelperConfig('title.max', $default);
    }
}

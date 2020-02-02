<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Title;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
    public function it_can_be_instantiated(): void
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
    public function it_can_get_default_title(): void
    {
        static::assertSame(
            $this->getDefaultTitle(),
            $this->title->getTitleOnly()
        );
    }

    /** @test */
    public function it_can_set_and_get_title(): void
    {
        $title = 'Awesome Title';

        $this->title->set($title);

        static::assertSame($title, $this->title->getTitleOnly());
    }

    /** @test */
    public function it_can_get_default_site_name(): void
    {
        static::assertSame(
            $this->getDefaultSiteName(),
            $this->title->getSiteName()
        );
    }

    /** @test */
    public function it_can_set_and_get_site_name(): void
    {
        $siteName = 'Company name';

        $this->title->setSiteName($siteName);

        static::assertSame($siteName, $this->title->getSiteName());
    }

    /** @test */
    public function it_can_get_default_separator(): void
    {
        static::assertSame(
            $this->getDefaultSeparator(),
            $this->title->getSeparator()
        );
    }

    /** @test */
    public function it_can_get_and_set_separator(): void
    {
        $separator = '|';
        $this->title->setSeparator($separator);

        static::assertSame($separator, $this->title->getSeparator());

        $separator = ' _ ';
        $this->title->setSeparator($separator);

        static::assertSame(trim($separator), $this->title->getSeparator());
    }

    /** @test */
    public function it_can_get_default_title_position(): void
    {
        static::assertSame(
            Arr::get($this->getTitleConfig(), 'first', true),
            $this->title->isTitleFirst()
        );
    }

    /** @test */
    public function it_can_switch_title_position(): void
    {
        static::assertTrue($this->title->isTitleFirst());

        $this->title->setLast();

        static::assertFalse($this->title->isTitleFirst());

        $this->title->setFirst();

        static::assertTrue($this->title->isTitleFirst());
    }

    /** @test */
    public function it_can_render_default_title(): void
    {
        $title    = $this->getDefaultTitle();
        $siteName = $this->getDefaultSiteName();
        $expected = "<title>{$title} - {$siteName}</title>";

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_render_custom_titles(): void
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
    public function it_can_make_title_tag(): void
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
    public function it_can_toggle_site_name_visibility(): void
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
    public function it_must_throw_title_exception_on_invalid_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The title must be a string value, [NULL] is given.');

        $this->title->set(null);
    }

    /** @test */
    public function it_must_throw_title_exception_on_empty_title(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The title is required and must not be empty.');

        $this->title->set('  ');
    }

    /** @test */
    public function it_can_set_and_get_max_length(): void
    {
        $this->title->setMax($max = 50);

        static::assertSame($max, $this->title->getMax());
    }

    /** @test */
    public function it_can_render_long_title(): void
    {
        $title = 'This is my long and awesome title that gonna blown your mind.';
        $max   = $this->getDefaultMax();

        $this->title->set($title)->setMax($max);

        $expected = '<title>'.Str::limit($title, $max).'</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_can_render_title_with_accents(): void
    {
        $this->title->set('Ce package est intuitif, exceptionnel et bien sûr opérationnel');

        $expected = '<title>Ce package est intuitif, exceptionnel et bien sûr opéra...</title>';

        static::assertHtmlStringEqualsHtmlString($expected, $this->title);
        static::assertHtmlStringEqualsHtmlString($expected, $this->title->render());
    }

    /** @test */
    public function it_must_throw_invalid_max_length_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The title maximum length must be integer.');

        $this->title->setMax(null);
    }

    /** @test */
    public function it_must_throw_invalid_max_length_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
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
    private function getTitleConfig(): array
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
    private function getDefaultTitle($default = ''): string
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
    private function getDefaultSiteName($default = ''): string
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
    private function getDefaultSeparator($default = '-'): string
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
    private function getDefaultMax($default = 55): int
    {
        return $this->getSeoHelperConfig('title.max', $default);
    }
}

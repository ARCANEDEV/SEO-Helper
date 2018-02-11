<?php namespace Arcanedev\SeoHelper\Tests\Traits;

use Arcanedev\SeoHelper\Tests\Stubs\Dummy;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     SeoableTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoableTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Tests\Stubs\Dummy */
    private $dummy;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->dummy = new Dummy;
    }

    public function tearDown()
    {
        unset($this->dummy);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_get_main_helper()
    {
        $seoHelper = $this->dummy->seo();

        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoHelper::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoHelper);
        }
    }

    /** @test */
    public function it_can_get_meta_helper()
    {
        $seoMeta = $this->dummy->seoMeta();

        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoMeta::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoMeta);
        }
    }

    /** @test */
    public function it_can_get_open_graph_helper()
    {
        $seoOpenGraph = $this->dummy->seoGraph();

        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoOpenGraph::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_get_twitter_card_helper()
    {
        $seoTwitter   = $this->dummy->seoCard();
        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoTwitter::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoTwitter);
        }
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $title        = 'Hello World';
        $siteName     = 'ARCANEDEV';
        $separator    = '|';
        $expectations = [
            "<title>$title $separator $siteName</title>",
            '<meta property="og:title" content="'.$title.'">',
            '<meta name="twitter:title" content="'.$title.'">',
        ];

        $this->dummy->setTitle($title, $siteName, $separator);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->dummy->seo()->render());
            static::assertContains($expected, (string) $this->dummy->seo());

            static::assertContains($expected, seo_helper()->render());
            static::assertContains($expected, (string) seo_helper());
        }
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $description  = 'ARCANEDEV super description';
        $expectations = [
            '<meta name="description" content="'.$description.'">',
            '<meta property="og:description" content="'.$description.'">',
            '<meta name="twitter:description" content="'.$description.'">',
        ];

        $this->dummy->setDescription($description);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->dummy->seo()->render());
            static::assertContains($expected, (string) $this->dummy->seo());

            static::assertContains($expected, seo_helper()->render());
            static::assertContains($expected, (string) seo_helper());
        }
    }

    /** @test */
    public function it_can_set_and_render_keywords()
    {
        $keywords = $this->getSeoHelperConfig('keywords.default');
        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        $this->dummy->setKeywords($keywords); // Array

        static::assertContains($expected, $this->dummy->seo()->render());
        static::assertContains($expected, (string) $this->dummy->seo());

        static::assertContains($expected, seo_helper()->render());
        static::assertContains($expected, (string) seo_helper());

        $this->dummy->setKeywords(implode(',', $keywords)); // String

        static::assertContains($expected, $this->dummy->seo()->render());
        static::assertContains($expected, (string) $this->dummy->seo());

        static::assertContains($expected, seo_helper()->render());
        static::assertContains($expected, (string) seo_helper());
    }
}

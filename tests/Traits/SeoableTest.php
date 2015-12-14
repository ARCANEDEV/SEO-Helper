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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @var  Dummy
     */
    private $dummy;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
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
            $this->assertInstanceOf($expected, $seoHelper);
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
            $this->assertInstanceOf($expected, $seoMeta);
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
            $this->assertInstanceOf($expected, $seoOpenGraph);
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
            $this->assertInstanceOf($expected, $seoTwitter);
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
            '<meta property="og:title" content="' . $title . '">',
            '<meta name="twitter:title" content="' . $title . '">',
        ];

        $this->dummy->setTitle($title, $siteName, $separator);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->dummy->seo()->render());
            $this->assertContains($expected, (string) $this->dummy->seo());

            $this->assertContains($expected, seo_helper()->render());
            $this->assertContains($expected, (string) seo_helper());
        }
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $description  = 'ARCANEDEV super description';
        $expectations = [
            '<meta name="description" content="' . $description . '">',
            '<meta property="og:description" content="' . $description . '">',
            '<meta name="twitter:description" content="' . $description . '">',
        ];

        $this->dummy->setDescription($description);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->dummy->seo()->render());
            $this->assertContains($expected, (string) $this->dummy->seo());

            $this->assertContains($expected, seo_helper()->render());
            $this->assertContains($expected, (string) seo_helper());
        }
    }

    /** @test */
    public function it_can_set_and_render_keywords()
    {
        $keywords = $this->getSeoHelperConfig('keywords.default');
        $expected = '<meta name="keywords" content="' . implode(', ', $keywords) . '">';

        $this->dummy->setKeywords($keywords); // Array

        $this->assertContains($expected, $this->dummy->seo()->render());
        $this->assertContains($expected, (string) $this->dummy->seo());

        $this->assertContains($expected, seo_helper()->render());
        $this->assertContains($expected, (string) seo_helper());

        $this->dummy->setKeywords(implode(',', $keywords)); // String

        $this->assertContains($expected, $this->dummy->seo()->render());
        $this->assertContains($expected, (string) $this->dummy->seo());

        $this->assertContains($expected, seo_helper()->render());
        $this->assertContains($expected, (string) seo_helper());
    }
}

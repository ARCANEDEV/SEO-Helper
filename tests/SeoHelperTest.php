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

        $this->seoHelper = $this->app[\Arcanedev\SeoHelper\Contracts\SeoHelper::class];
    }

    public function tearDown()
    {
        unset($this->seoHelper);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoHelper::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_be_instantiated_with_helper()
    {
        $this->seoHelper = seo_helper();
        $expectations    = [
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoHelper::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_get_seo_meta()
    {
        $seoMeta = $this->seoHelper->meta();

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
    public function it_can_get_seo_open_graph()
    {
        $ogs = [
            $this->seoHelper->openGraph(),
            $this->seoHelper->og(), // Alias
        ];

        $expectations = [
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoOpenGraph::class,
        ];

        foreach ($ogs as $seoOpenGraph) {
            foreach ($expectations as $expected) {
                $this->assertInstanceOf($expected, $seoOpenGraph);
            }
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
            '<meta property="og:site_name" content="' . $siteName . '">',
            '<meta name="twitter:title" content="' . $title . '">',
        ];

        $this->seoHelper->setTitle($title, $siteName, $separator);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->seoHelper->render());
            $this->assertContains($expected, (string) $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_set_and_render_site_name()
    {
        $title        = 'My Application';
        $siteName     = 'ARCANEDEV';
        $expectations = [
            "<title>{$title} - {$siteName}</title>",
            '<meta property="og:title" content="' . $title . '">',
            '<meta property="og:site_name" content="' . $siteName . '">',
            '<meta name="twitter:title" content="' . $title . '">',
        ];

        $this->seoHelper->setSiteName($siteName)
                        ->setTitle($title);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->seoHelper->render());
            $this->assertContains($expected, (string) $this->seoHelper);
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

        $this->seoHelper->setDescription($description);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->seoHelper->render());
            $this->assertContains($expected, (string) $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_set_and_render_keywords()
    {
        $keywords = $this->getSeoHelperConfig('keywords.default');
        $expected = '<meta name="keywords" content="' . implode(', ', $keywords) . '">';

        $this->seoHelper->setKeywords($keywords); // Array

        $this->assertContains($expected, $this->seoHelper->render());
        $this->assertContains($expected, (string) $this->seoHelper);

        $this->seoHelper->setKeywords(implode(',', $keywords)); // String

        $this->assertContains($expected, $this->seoHelper->render());
        $this->assertContains($expected, (string) $this->seoHelper);
    }

    /** @test */
    public function it_can_render_all()
    {
        $output = $this->seoHelper->render();

        $this->assertNotEmpty($output);
    }

    /** @test */
    public function it_can_render_all_with_html_string_object()
    {
        $output = $this->seoHelper->renderHtml();

        $this->assertInstanceOf(\Illuminate\Support\HtmlString::class, $output);
        $this->assertNotEmpty($output->toHtml());
    }

    /** @test */
    public function it_can_enable_and_disable_open_graph()
    {
        $needle = '<meta property="og:';

        $this->assertTrue($this->seoHelper->openGraph()->isEnabled());
        $this->assertFalse($this->seoHelper->openGraph()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->disableOpenGraph();

        $this->assertFalse($this->seoHelper->openGraph()->isEnabled());
        $this->assertTrue($this->seoHelper->openGraph()->isDisabled());
        $this->assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->enableOpenGraph();

        $this->assertTrue($this->seoHelper->openGraph()->isEnabled());
        $this->assertFalse($this->seoHelper->openGraph()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->openGraph()->disable();

        $this->assertFalse($this->seoHelper->openGraph()->isEnabled());
        $this->assertTrue($this->seoHelper->openGraph()->isDisabled());
        $this->assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->openGraph()->enable();

        $this->assertTrue($this->seoHelper->openGraph()->isEnabled());
        $this->assertFalse($this->seoHelper->openGraph()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());
    }

    /** @test */
    public function it_can_enable_and_disable_twitter_card()
    {
        $needle = '<meta name="twitter:';

        $this->assertTrue($this->seoHelper->twitter()->isEnabled());
        $this->assertFalse($this->seoHelper->twitter()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->disableTwitter();

        $this->assertFalse($this->seoHelper->twitter()->isEnabled());
        $this->assertTrue($this->seoHelper->twitter()->isDisabled());
        $this->assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->enableTwitter();

        $this->assertTrue($this->seoHelper->twitter()->isEnabled());
        $this->assertFalse($this->seoHelper->twitter()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->twitter()->disable();

        $this->assertFalse($this->seoHelper->twitter()->isEnabled());
        $this->assertTrue($this->seoHelper->twitter()->isDisabled());
        $this->assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->twitter()->enable();

        $this->assertTrue($this->seoHelper->twitter()->isEnabled());
        $this->assertFalse($this->seoHelper->twitter()->isDisabled());
        $this->assertContains($needle, $this->seoHelper->render());
    }
}

<?php namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\Contracts\SeoHelper as SeoHelperContract;

/**
 * Class     SeoHelperTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelperTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\SeoHelper */
    private $seoHelper;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->seoHelper = $this->app[SeoHelperContract::class];
    }

    public function tearDown()
    {
        unset($this->seoHelper);

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
            \Arcanedev\SeoHelper\Contracts\SeoHelper::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\SeoHelper::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->seoHelper);
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
            static::assertInstanceOf($expected, $this->seoHelper);
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
            static::assertInstanceOf($expected, $seoMeta);
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
                static::assertInstanceOf($expected, $seoOpenGraph);
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
            '<meta property="og:title" content="'.$title.'">',
            '<meta property="og:site_name" content="'.$siteName.'">',
            '<meta name="twitter:title" content="'.$title.'">',
        ];

        $this->seoHelper->setTitle($title, $siteName, $separator);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->seoHelper->render());
            static::assertContains($expected, (string) $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_set_and_render_site_name()
    {
        $title        = 'My Application';
        $siteName     = 'ARCANEDEV';
        $expectations = [
            "<title>{$title} - {$siteName}</title>",
            '<meta property="og:title" content="'.$title.'">',
            '<meta property="og:site_name" content="'.$siteName.'">',
            '<meta name="twitter:title" content="'.$title.'">',
        ];

        $this->seoHelper->setSiteName($siteName)
                        ->setTitle($title);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->seoHelper->render());
            static::assertContains($expected, (string) $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_toggle_site_name_visibility()
    {
        $title    = 'My Application';
        $siteName = 'ARCANEDEV';

        $this->seoHelper->setTitle($title, $siteName);

        static::assertContains(
            "<title>{$title} - {$siteName}</title>",
            $this->seoHelper->render()
        );

        $this->seoHelper->hideSiteName();

        static::assertContains(
            "<title>{$title}</title>",
            $this->seoHelper->render()
        );

        $this->seoHelper->showSiteName();

        static::assertContains(
            "<title>{$title} - {$siteName}</title>",
            $this->seoHelper->render()
        );
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

        $this->seoHelper->setDescription($description);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->seoHelper->render());
            static::assertContains($expected, (string) $this->seoHelper);
        }
    }

    /** @test */
    public function it_can_set_and_render_keywords()
    {
        $keywords = $this->getSeoHelperConfig('keywords.default');
        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        $this->seoHelper->setKeywords($keywords); // Array

        static::assertContains($expected, $this->seoHelper->render());
        static::assertContains($expected, (string) $this->seoHelper);

        $this->seoHelper->setKeywords(implode(',', $keywords)); // String

        static::assertContains($expected, $this->seoHelper->render());
        static::assertContains($expected, (string) $this->seoHelper);
    }

    /** @test */
    public function it_can_set_and_render_image()
    {
        $this->seoHelper->setImage($imageUrl = 'http://localhost/assets/img/logo.png');

        $expectations = [
            '<meta property="og:image" content="'.$imageUrl.'">',
            '<meta name="twitter:image" content="'.$imageUrl.'">'
        ];

        $rendered = $this->seoHelper->render();

        foreach ($expectations as $expected) {
            static::assertContains($expected, $rendered);
        }
    }

    /** @test */
    public function it_can_render_all()
    {
        $output = $this->seoHelper->render();

        static::assertNotEmpty($output);
    }

    /** @test */
    public function it_can_render_all_with_html_string_object()
    {
        $output = $this->seoHelper->renderHtml();

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $output);
        static::assertNotEmpty($output->toHtml());
    }

    /** @test */
    public function it_can_enable_and_disable_open_graph()
    {
        $needle = '<meta property="og:';

        static::assertTrue($this->seoHelper->openGraph()->isEnabled());
        static::assertFalse($this->seoHelper->openGraph()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->disableOpenGraph();

        static::assertFalse($this->seoHelper->openGraph()->isEnabled());
        static::assertTrue($this->seoHelper->openGraph()->isDisabled());
        static::assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->enableOpenGraph();

        static::assertTrue($this->seoHelper->openGraph()->isEnabled());
        static::assertFalse($this->seoHelper->openGraph()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->openGraph()->disable();

        static::assertFalse($this->seoHelper->openGraph()->isEnabled());
        static::assertTrue($this->seoHelper->openGraph()->isDisabled());
        static::assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->openGraph()->enable();

        static::assertTrue($this->seoHelper->openGraph()->isEnabled());
        static::assertFalse($this->seoHelper->openGraph()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());
    }

    /** @test */
    public function it_can_enable_and_disable_twitter_card()
    {
        $needle = '<meta name="twitter:';

        static::assertTrue($this->seoHelper->twitter()->isEnabled());
        static::assertFalse($this->seoHelper->twitter()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->disableTwitter();

        static::assertFalse($this->seoHelper->twitter()->isEnabled());
        static::assertTrue($this->seoHelper->twitter()->isDisabled());
        static::assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->enableTwitter();

        static::assertTrue($this->seoHelper->twitter()->isEnabled());
        static::assertFalse($this->seoHelper->twitter()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());

        $this->seoHelper->twitter()->disable();

        static::assertFalse($this->seoHelper->twitter()->isEnabled());
        static::assertTrue($this->seoHelper->twitter()->isDisabled());
        static::assertNotContains($needle, $this->seoHelper->render());

        $this->seoHelper->twitter()->enable();

        static::assertTrue($this->seoHelper->twitter()->isEnabled());
        static::assertFalse($this->seoHelper->twitter()->isDisabled());
        static::assertContains($needle, $this->seoHelper->render());
    }
}

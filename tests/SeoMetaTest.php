<?php namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\SeoMeta;

/**
 * Class     SeoMetaTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMetaTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\SeoMeta */
    private $seoMeta;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $configs       = $this->getSeoHelperConfig();
        $this->seoMeta = new SeoMeta($configs);

        $this->seoMeta->setUrl($this->baseUrl);
    }

    public function tearDown()
    {
        unset($this->seoMeta);

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
            \Arcanedev\SeoHelper\SeoMeta::class,
            \Arcanedev\SeoHelper\Contracts\SeoMeta::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->seoMeta);
        }

        static::assertNotEmpty($this->seoMeta->render());
    }

    /** @test */
    public function it_can_be_instantiated_by_container()
    {
        $this->seoMeta = $this->app[SeoMetaContract::class];

        static::assertInstanceOf(SeoMeta::class, $this->seoMeta);
        static::assertNotEmpty($this->seoMeta->render());
        static::assertNotEmpty((string) $this->seoMeta);
    }

    /** @test */
    public function it_can_set_and_get_and_render_title()
    {
        $title    = 'Awesome Title';
        $siteName = $this->getSeoHelperConfig('title.site-name');

        $this->seoMeta->setTitle($title);

        $expected = "<title>{$title} - {$siteName}</title>";

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $siteName = 'Company name';
        $this->seoMeta->setTitle($title, $siteName);

        $expected = "<title>{$title} - {$siteName}</title>";

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $separator = '|';
        $this->seoMeta->setTitle($title, $siteName, $separator);

        $expected = "<title>$title $separator $siteName</title>";

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_set_and_get_and_render_description()
    {
        $description = 'Awesome Description';
        $this->seoMeta->setDescription($description);

        $expected = '<meta name="description" content="'.$description.'">';

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_set_and_get_and_render_keywords()
    {
        $keywords = ['keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'];

        $this->seoMeta->setKeywords($keywords);

        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $this->seoMeta->setKeywords(implode(',', $keywords));

        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $this->seoMeta->setKeywords(null);

        static::assertNotContains('name="keywords"', $this->seoMeta->render());
        static::assertNotContains('name="keywords"', (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_add_one_keyword()
    {
        $keywords = ['keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'];
        $this->seoMeta->setKeywords($keywords);

        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $keywords[] = $keyword = 'keyword-6';
        $this->seoMeta->addKeyword($keyword);

        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_add_many_keywords()
    {
        $keywords = ['keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'];
        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';
        $this->seoMeta->setKeywords($keywords);

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);

        $new       = ['keyword-6', 'keyword-7', 'keyword-8'];
        $keywords  = array_merge($keywords, $new);
        $expected  = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        $this->seoMeta->addKeywords($new);

        static::assertContains($expected, $this->seoMeta->render());
        static::assertContains($expected, (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_add_remove_reset_and_render_a_misc_tag()
    {
        $expectations = [
            '<meta name="robots" content="noindex, nofollow">',
            '<link rel="canonical" href="'.$this->baseUrl.'">'
        ];

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->seoMeta->render());
            static::assertContains($expected, (string) $this->seoMeta);
        }

        $this->seoMeta->removeMeta(['robots', 'canonical']);
        $output = $this->seoMeta->render();

        foreach ($expectations as $expected) {
            static::assertNotContains($expected, $output);
            static::assertNotContains($expected, (string) $this->seoMeta);
        }

        $this->seoMeta->addMetas([
            'copyright' => 'ARCANEDEV',
            'expires'   => 'never',
        ]);

        $output = $this->seoMeta->render();

        $expectations = [
            '<meta name="copyright" content="ARCANEDEV">',
            '<meta name="expires" content="never">',
        ];

        foreach ($expectations as $expected) {
            static::assertContains($expected, $output);
        }

        $this->seoMeta->removeMeta('copyright');

        static::assertNotContains(
            '<meta name="copyright" content="ARCANEDEV">',
            $this->seoMeta->render()
        );

        $this->seoMeta->removeMeta('expires');

        static::assertNotContains(
            '<meta name="expires" content="never">',
            $this->seoMeta->render()
        );

        $this->seoMeta->addMeta('viewport', 'width=device-width, initial-scale=1.0');

        static::assertContains(
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
            $this->seoMeta->render()
        );

        $this->seoMeta->addMetas([
            'copyright' => 'ARCANEDEV',
            'expires'   => 'never',
        ]);

        $this->seoMeta->resetMetas();

        foreach (['viewport', 'copyright', 'expires'] as $blacklisted) {
            static::assertNotContains($blacklisted, $this->seoMeta->render());
        }
    }

    /** @test */
    public function it_can_render_add_reset_webmasters()
    {
        $expectations = [
            '<meta name="google-site-verification" content="site-verification-code">',
            '<meta name="msvalidate.01" content="site-verification-code">',
            '<meta name="alexaVerifyID" content="site-verification-code">',
            '<meta name="p:domain_verify" content="site-verification-code">',
            '<meta name="yandex-verification" content="site-verification-code">',
        ];

        foreach ($expectations as $excepted) {
            static::assertContains($excepted, $this->seoMeta->render());
            static::assertContains($excepted, (string) $this->seoMeta);
        }

        $this->seoMeta->resetWebmasters();

        foreach ($expectations as $excepted) {
            static::assertNotContains($excepted, $this->seoMeta->render());
            static::assertNotContains($excepted, (string) $this->seoMeta);
        }

        $this->seoMeta->addWebmaster('google', 'site-verification-code');

        $excepted = '<meta name="google-site-verification" content="site-verification-code">';

        static::assertContains($excepted, $this->seoMeta->render());
        static::assertContains($excepted, (string) $this->seoMeta);
    }

    /** @test */
    public function it_can_set_and_render_google_analytics()
    {
        static::assertContains(
            "ga('create', 'UA-12345678-9', 'auto');",
            $this->seoMeta->render()
        );

        $this->seoMeta->setGoogleAnalytics('UA-98765432-1');

        static::assertContains(
            "ga('create', 'UA-98765432-1', 'auto');",
            $this->seoMeta->render()
        );
    }
}

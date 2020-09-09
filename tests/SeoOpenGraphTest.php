<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\SeoOpenGraph;

/**
 * Class     SeoOpenGraphTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraphTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\SeoOpenGraph */
    private $seoOpenGraph;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $configs            = $this->getSeoHelperConfig();
        $this->seoOpenGraph = new SeoOpenGraph($configs);
    }

    public function tearDown(): void
    {
        unset($this->seoOpenGraph);

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
            \Arcanedev\SeoHelper\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\SeoOpenGraph::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_render_defaults(): void
    {
        $expectations = [
            '<meta property="og:type" content="website">',
            '<meta property="og:title" content="Default Open Graph title">',
            '<meta property="og:description" content="Default Open Graph description">',
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->seoOpenGraph->render());
            static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_set_and_render_prefix(): void
    {
        $this->seoOpenGraph->setPrefix('open-graph:');

        $expectations = [
            '<meta property="open-graph:type" content="website">',
            '<meta property="open-graph:title" content="Default Open Graph title">',
            '<meta property="open-graph:description" content="Default Open Graph description">',
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->seoOpenGraph->render());
            static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_set_and_render_type(): void
    {
        $types = [
            'article',
            'video',
            'video.movie',
            'video.episode',
        ];

        foreach ($types as $type) {
            $this->seoOpenGraph->setType($type);

            $expected = '<meta property="og:type" content="'.$type.'">';

            static::assertStringContainsString($expected, $this->seoOpenGraph->render());
            static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_set_and_render_title(): void
    {
        $title = 'Hello World';

        $this->seoOpenGraph->setTitle($title);

        $expected = '<meta property="og:title" content="'.$title.'">';

        static::assertStringContainsString($expected, $this->seoOpenGraph->render());
        static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
    }

    /** @test */
    public function it_can_set_and_render_description(): void
    {
        $description = 'Hello World detailed description.';

        $this->seoOpenGraph->setDescription($description);

        $expected = '<meta property="og:description" content="'.$description.'">';

        static::assertStringContainsString($expected, $this->seoOpenGraph->render());
        static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
    }

    /** @test */
    public function it_can_set_and_render_url(): void
    {
        $url = 'http://www.imdb.com/title/tt0080339/';

        $this->seoOpenGraph->setUrl($url);

        $expected = '<meta property="og:url" content="'.$url.'">';

        static::assertStringContainsString($expected, $this->seoOpenGraph->render());
        static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
    }

    /** @test */
    public function it_can_set_and_render_image(): void
    {
        $image = 'http://ia.media-imdb.com/images/M/MV5BNDU2MjE4MTcwNl5BMl5BanBnXkFtZTgwNDExOTMxMDE@._V1_UY1200_CR90,0,630,1200_AL_.jpg';

        $this->seoOpenGraph->setImage($image);

        $expected = '<meta property="og:image" content="'.$image.'">';

        static::assertStringContainsString($expected, $this->seoOpenGraph->render());
        static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
    }

    /** @test */
    public function it_can_set_and_render_site_name(): void
    {
        $siteName = 'My site name';

        $this->seoOpenGraph->setSiteName($siteName);

        $expected = '<meta property="og:site_name" content="'.$siteName.'">';

        static::assertStringContainsString($expected, $this->seoOpenGraph->render());
        static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
    }

    /** @test */
    public function it_can_add_and_render_property(): void
    {
        $locales = [
            'ar', 'en', 'en_US', 'es', 'fr', 'fr_FR',
        ];

        foreach ($locales as $locale) {
            $this->seoOpenGraph->addProperty('locale', $locale);

            $expected = '<meta property="og:locale" content="'.$locale.'">';

            static::assertStringContainsString($expected, $this->seoOpenGraph->render());
            static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_add_render_properties(): void
    {
        $properties = [
            'locale'           => 'en_GB',
            'profile:username' => 'ARCANEDEV'
        ];

        $expectations = [];

        foreach ($properties as $property => $content) {
            $expectations[] = '<meta property="og:'.$property.'" content="'.$content.'">';
        }

        $this->seoOpenGraph->addProperties($properties);

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->seoOpenGraph->render());
            static::assertStringContainsString($expected, (string) $this->seoOpenGraph);
        }
    }

    /** @test */
    public function it_can_enable_and_disable(): void
    {
        static::assertTrue($this->seoOpenGraph->isEnabled());
        static::assertFalse($this->seoOpenGraph->isDisabled());
        static::assertNotEmpty($this->seoOpenGraph->render());

        $this->seoOpenGraph->disable();

        static::assertFalse($this->seoOpenGraph->isEnabled());
        static::assertTrue($this->seoOpenGraph->isDisabled());
        static::assertEmpty($this->seoOpenGraph->render());

        $this->seoOpenGraph->enable();

        static::assertTrue($this->seoOpenGraph->isEnabled());
        static::assertFalse($this->seoOpenGraph->isDisabled());
        static::assertNotEmpty($this->seoOpenGraph->render());
    }

    /** @test */
    public function it_can_set_and_render_locale_property(): void
    {
        $locales = ['fr_FR', 'en_GB', 'es_ES'];

        foreach ($locales as $locale) {
            static::assertStringContainsString(
                '<meta property="og:locale" content="'.$locale.'">',
                $this->seoOpenGraph->setLocale($locale)->render()
            );
        }
    }

    /** @test */
    public function it_can_set_and_render_alternative_properties(): void
    {
        $this->seoOpenGraph->setAlternativeLocales(['fr_FR', 'en_GB', 'es_ES']);

        $expectations = [
            '<meta property="og:locale:alternate" content="fr_FR">',
            '<meta property="og:locale:alternate" content="en_GB">',
            '<meta property="og:locale:alternate" content="es_ES">',
        ];

        $actual = $this->seoOpenGraph->render();

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $actual);
        }
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities\OpenGraph;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraph as OpenGraphContract;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     GraphTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GraphTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private OpenGraphContract $og;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->og = new Graph(
            $this->getSeoHelperConfig('open-graph')
        );
    }

    public function tearDown(): void
    {
        unset($this->og);

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
            Renderable::class,
            OpenGraphContract::class,
            Graph::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->og);
        }
    }

    /** @test */
    public function it_can_render_defaults(): void
    {
        $output   = $this->og->render();
        $expected = '<meta property="og:type" content="website">' .
            '<meta property="og:title" content="Default Open Graph title">' .
            '<meta property="og:description" content="Default Open Graph description">';

        static::assertHtmlStringEqualsHtmlString($expected, $output);
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
            $this->og->setType($type);

            $expected = '<meta property="og:type" content="' . $type . '">';

            static::assertStringContainsString($expected, $this->og->render());
            static::assertStringContainsString($expected, (string) $this->og);
        }
    }

    /** @test */
    public function it_can_set_and_render_title(): void
    {
        $title = 'Hello World';

        $this->og->setTitle($title);

        $expected = '<meta property="og:title" content="' . $title . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
    }

    /** @test */
    public function it_can_set_and_render_description(): void
    {
        $description = 'Hello World detailed description.';

        $this->og->setDescription($description);

        $expected = '<meta property="og:description" content="' . $description . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
    }

    /** @test */
    public function it_can_set_and_render_url(): void
    {
        $url = 'http://www.imdb.com/title/tt0080339/';

        $this->og->setUrl($url);

        $expected = '<meta property="og:url" content="' . $url . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
    }

    /** @test */
    public function it_can_set_and_render_image(): void
    {
        $image = 'http://ia.media-imdb.com/images/M/MV5BNDU2MjE4MTcwNl5BMl5BanBnXkFtZTgwNDExOTMxMDE@._V1_UY1200_CR90,0,630,1200_AL_.jpg';

        $this->og->setImage($image);

        $expected = '<meta property="og:image" content="' . $image . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
    }

    /** @test */
    public function it_can_set_and_render_site_name(): void
    {
        $siteName = 'My site name';

        $this->og->setSiteName($siteName);

        $expected = '<meta property="og:site_name" content="' . $siteName . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
    }

    /** @test */
    public function it_can_add_render_property(): void
    {
        $locale = 'en_GB';

        $this->og->addProperty('locale', $locale);

        $expected = '<meta property="og:locale" content="' . $locale . '">';

        static::assertStringContainsString($expected, $this->og->render());
        static::assertStringContainsString($expected, (string) $this->og);
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
            $expectations[] = '<meta property="og:' . $property . '" content="' . $content . '">';
        }

        $this->og->addProperties($properties);

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->og->render());
            static::assertStringContainsString($expected, (string) $this->og);
        }
    }

    /** @test */
    public function it_can_set_and_render_locale_property(): void
    {
        $locales = ['fr_FR', 'en_GB', 'es_ES'];

        foreach ($locales as $locale) {
            static::assertStringContainsString(
                '<meta property="og:locale" content="' . $locale . '">',
                $this->og->setLocale($locale)->render()
            );
        }
    }

    /** @test */
    public function it_can_set_and_render_alternative_properties(): void
    {
        $this->og->setAlternativeLocales(['fr_FR', 'en_GB', 'es_ES']);

        $expectations = [
            '<meta property="og:locale:alternate" content="fr_FR">',
            '<meta property="og:locale:alternate" content="en_GB">',
            '<meta property="og:locale:alternate" content="es_ES">',
        ];

        $actual = $this->og->render();

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $actual);
        }
    }
}

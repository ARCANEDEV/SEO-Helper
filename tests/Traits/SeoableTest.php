<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Traits;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Contracts\SeoHelper as SeoHelperContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Arcanedev\SeoHelper\SeoHelper;
use Arcanedev\SeoHelper\SeoMeta;
use Arcanedev\SeoHelper\SeoOpenGraph;
use Arcanedev\SeoHelper\SeoTwitter;
use Arcanedev\SeoHelper\Tests\Stubs\Dummy;
use Arcanedev\SeoHelper\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

/**
 * Class     SeoableTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoableTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private Dummy $dummy;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->dummy = new Dummy();
    }

    public function tearDown(): void
    {
        unset($this->dummy);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    #[Test]
    public function it_can_get_main_helper(): void
    {
        $seoHelper = $this->dummy->seo();

        $expectations = [
            Renderable::class,
            SeoHelperContract::class,
            SeoHelper::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoHelper);
        }
    }

    #[Test]
    public function it_can_get_meta_helper(): void
    {
        $seoMeta = $this->dummy->seoMeta();

        $expectations = [
            Renderable::class,
            SeoMetaContract::class,
            SeoMeta::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoMeta);
        }
    }

    #[Test]
    public function it_can_get_open_graph_helper(): void
    {
        $seoOpenGraph = $this->dummy->seoGraph();

        $expectations = [
            Renderable::class,
            SeoOpenGraphContract::class,
            SeoOpenGraph::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoOpenGraph);
        }
    }

    #[Test]
    public function it_can_get_twitter_card_helper(): void
    {
        $seoTwitter   = $this->dummy->seoCard();
        $expectations = [
            Renderable::class,
            SeoTwitterContract::class,
            SeoTwitter::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $seoTwitter);
        }
    }

    #[Test]
    public function it_can_set_and_render_title(): void
    {
        $title = 'Hello World';
        $siteName = 'ARCANEDEV';
        $separator = '|';
        $expectations = [
            "<title>{$title} {$separator} {$siteName}</title>",
            '<meta property="og:title" content="' . $title . '">',
            '<meta name="twitter:title" content="' . $title . '">',
        ];

        $this->dummy->setTitle($title, $siteName, $separator);

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->dummy->seo()->render());
            static::assertStringContainsString($expected, (string) $this->dummy->seo());

            static::assertStringContainsString($expected, seo_helper()->render());
            static::assertStringContainsString($expected, (string) seo_helper());
        }
    }

    #[Test]
    public function it_can_set_and_render_description(): void
    {
        $description  = 'ARCANEDEV super description';
        $expectations = [
            '<meta name="description" content="' . $description . '">',
            '<meta property="og:description" content="' . $description . '">',
            '<meta name="twitter:description" content="' . $description . '">',
        ];

        $this->dummy->setDescription($description);

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->dummy->seo()->render());
            static::assertStringContainsString($expected, (string) $this->dummy->seo());

            static::assertStringContainsString($expected, seo_helper()->render());
            static::assertStringContainsString($expected, (string) seo_helper());
        }
    }

    #[Test]
    public function it_can_set_and_render_keywords(): void
    {
        $keywords = $this->getSeoHelperConfig('keywords.default');
        $expected = '<meta name="keywords" content="' . implode(', ', $keywords) . '">';

        $this->dummy->setKeywords($keywords); // Array

        static::assertStringContainsString($expected, $this->dummy->seo()->render());
        static::assertStringContainsString($expected, (string) $this->dummy->seo());

        static::assertStringContainsString($expected, seo_helper()->render());
        static::assertStringContainsString($expected, (string) seo_helper());

        $this->dummy->setKeywords(implode(',', $keywords)); // String

        static::assertStringContainsString($expected, $this->dummy->seo()->render());
        static::assertStringContainsString($expected, (string) $this->dummy->seo());

        static::assertStringContainsString($expected, seo_helper()->render());
        static::assertStringContainsString($expected, (string) seo_helper());
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Webmasters;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     WebmastersTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class WebmastersTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\Webmasters */
    private $webmasters;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $configs          = $this->getSeoHelperConfig('webmasters');
        $this->webmasters = new Webmasters($configs);
    }

    public function tearDown(): void
    {
        unset($this->webmasters);

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
            \Arcanedev\SeoHelper\Entities\Webmasters::class,
            \Arcanedev\SeoHelper\Contracts\Entities\Webmasters::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->webmasters);
        }
    }

    /** @test */
    public function it_can_render_defaults(): void
    {
        $expectations = [
            '<meta name="google-site-verification" content="site-verification-code">',
            '<meta name="msvalidate.01" content="site-verification-code">',
            '<meta name="alexaVerifyID" content="site-verification-code">',
            '<meta name="p:domain_verify" content="site-verification-code">',
            '<meta name="yandex-verification" content="site-verification-code">',
        ];

        foreach ($expectations as $excepted) {
            static::assertStringContainsString($excepted, $this->webmasters->render());
            static::assertStringContainsString($excepted, (string) $this->webmasters);
        }
    }

    /** @test */
    public function it_can_make_and_add(): void
    {
        $this->webmasters = Webmasters::make([
            'google'  => 'site-verification-code'
        ]);

        $this->webmasters->add('bing', 'site-verification-code');

        $expectations = [
            '<meta name="google-site-verification" content="site-verification-code">',
            '<meta name="msvalidate.01" content="site-verification-code">',
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->webmasters->render());
            static::assertStringContainsString($expected, (string) $this->webmasters);
        }
    }

    /** @test */
    public function it_can_skip_unsupported_webmasters(): void
    {
        $this->webmasters = Webmasters::make([
            'duckduckgo'  => 'site-verification-code'
        ]);

        static::assertEmpty($this->webmasters->render());
        static::assertEmpty((string) $this->webmasters);
    }

    /** @test */
    public function it_can_reset(): void
    {
        static::assertNotEmpty($this->webmasters->render());
        static::assertNotEmpty((string) $this->webmasters);

        $this->webmasters->reset();

        static::assertEmpty($this->webmasters->render());
        static::assertEmpty((string) $this->webmasters);
    }
}

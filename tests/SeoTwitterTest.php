<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Arcanedev\SeoHelper\SeoTwitter;
use PHPUnit\Framework\Attributes\Test;

/**
 * Class     SeoTwitterTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoTwitterTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private SeoTwitterContract $seoTwitter;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->seoTwitter = new SeoTwitter(
            $this->getSeoHelperConfig()
        );
    }

    public function tearDown(): void
    {
        unset($this->seoTwitter);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    #[Test]
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            Renderable::class,
            SeoTwitterContract::class,
            SeoTwitter::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->seoTwitter);
        }
    }

    #[Test]
    public function it_can_render_defaults(): void
    {
        $output = $this->seoTwitter->render();

        $expectations = [
            '<meta name="twitter:card" content="summary">',
            '<meta name="twitter:site" content="@Username">',
            '<meta name="twitter:title" content="Default Twitter Card title">',
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $output);
        }
    }

    #[Test]
    public function it_can_set_and_render_type(): void
    {
        $this->seoTwitter->setType('app');

        $expected = '<meta name="twitter:card" content="app">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_set_and_render_site(): void
    {
        $this->seoTwitter->setSite('Arcanedev');

        $expected = '<meta name="twitter:site" content="@Arcanedev">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_set_and_render_title(): void
    {
        $this->seoTwitter->setTitle('ARCANEDEV super title');

        $expected = '<meta name="twitter:title" content="ARCANEDEV super title">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_set_and_render_description(): void
    {
        $this->seoTwitter->setDescription('ARCANEDEV super description');

        $expected = '<meta name="twitter:description" content="ARCANEDEV super description">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_add_and_render_image(): void
    {
        $this->seoTwitter->addImage('http://example.com/img/avatar.png');

        $expected = '<meta name="twitter:image" content="http://example.com/img/avatar.png">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_reset_card(): void
    {
        $expected = $this->seoTwitter->render();

        $this->seoTwitter->setType('app');
        $this->seoTwitter->setSite('Arcanedev');
        $this->seoTwitter->setTitle('Arcanedev super title');
        $this->seoTwitter->addImage('http://example.com/img/avatar.png');

        static::assertNotSame($expected, $this->seoTwitter->render());

        $this->seoTwitter->reset();

        static::assertSame($expected, $this->seoTwitter->render());
    }

    #[Test]
    public function it_can_add_and_render_a_meta(): void
    {
        $this->seoTwitter->addMeta('creator', '@Arcanedev');

        $expected = '<meta name="twitter:creator" content="@Arcanedev">';

        static::assertStringContainsString($expected, $this->seoTwitter->render());
        static::assertStringContainsString($expected, (string) $this->seoTwitter);
    }

    #[Test]
    public function it_can_add_and_render_many_metas(): void
    {
        $metas = [
            'creator' => '@Arcanedev',
            'url'     => 'http://www.arcanedev.net',
        ];

        $expectations = [];

        foreach ($metas as $name => $content) {
            $expectations[] = '<meta name="twitter:' . $name . '" content="' . $content . '">';
        }

        $this->seoTwitter->addMetas($metas);

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $this->seoTwitter->render());
            static::assertStringContainsString($expected, (string) $this->seoTwitter);
        }
    }

    #[Test]
    public function it_can_enable_and_disable(): void
    {
        static::assertTrue($this->seoTwitter->isEnabled());
        static::assertFalse($this->seoTwitter->isDisabled());
        static::assertNotEmpty($this->seoTwitter->render());

        $this->seoTwitter->disable();

        static::assertFalse($this->seoTwitter->isEnabled());
        static::assertTrue($this->seoTwitter->isDisabled());
        static::assertEmpty($this->seoTwitter->render());

        $this->seoTwitter->enable();

        static::assertTrue($this->seoTwitter->isEnabled());
        static::assertFalse($this->seoTwitter->isDisabled());
        static::assertNotEmpty($this->seoTwitter->render());
    }
}

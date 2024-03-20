<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Helpers;

use Arcanedev\SeoHelper\Contracts\Helpers\Meta as MetaContract;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Helpers\Meta;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     MetaTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $results = [
            Meta::make('name', 'Hello world'),
            new Meta('name', 'Hello world'),
        ];
        $expectations = [
            Renderable::class,
            MetaContract::class,
            Meta::class,
        ];

        foreach ($results as $actual) {
            /** @var Meta $actual */
            foreach ($expectations as $expected) {
                static::assertInstanceOf($expected, $actual);
            }

            static::assertSame('name', $actual->key());
            static::assertTrue($actual->isValid());
        }
    }

    /** @test */
    public function it_can_valid(): void
    {
        $validMetas = [
            Meta::make('name', 'Hello world')
        ];

        foreach ($validMetas as $meta) {
            /** @var Meta $meta */
            static::assertTrue($meta->isValid());
        }

        $invalidMetas = [
            Meta::make('name', ''),
            Meta::make('name', []),   // You shall not pass !
        ];

        foreach ($invalidMetas as $meta) {
            /** @var Meta $meta */
            static::assertFalse($meta->isValid());
        }
    }

    /** @test */
    public function it_can_render(): void
    {
        static::assertSame(
            '<meta name="name" content="Hello world">',
            Meta::make('name', 'Hello world')->render()
        );

        static::assertSame(
            '<meta name="name" content="Hello world">',
            (string) Meta::make('name', 'Hello world')
        );

        static::assertSame(
            '<meta name="viewport" content="width=device-width, initial-scale=1">',
            Meta::make('viewport', 'width=device-width, initial-scale=1')->render()
        );

        static::assertSame(
            '<link rel="author" href="https://plus.google.com/+ArcanedevNetMaroc">',
            Meta::make('author', 'https://plus.google.com/+ArcanedevNetMaroc')->render()
        );
    }

    /** @test */
    public function it_can_make_meta_with_prefix(): void
    {
        $meta = Meta::make('hello', 'Hello World', 'name', 'say:');

        static::assertSame(
            '<meta name="say:hello" content="Hello World">',
            $meta->render()
        );

        $meta = Meta::make('hello', 'Hello World');

        static::assertSame(
            '<meta name="say:hello" content="Hello World">',
            $meta->setPrefix('say:')->render()
        );
    }

    /** @test */
    public function it_can_clean_and_render(): void
    {
        $name    = '<b>Awesome name</b>';
        $content = 'Harmless <script>alert("Danger Zone");</script>';

        static::assertSame(
            '<meta name="Awesome-name" content="Harmless alert(&quot;Danger Zone&quot;);">',
            Meta::make($name, $content)->render()
        );
    }

    /** @test */
    public function it_can_make_meta_with_custom_name_property(): void
    {
        $meta = Meta::make('title', 'Hello World', 'property', 'og:');

        static::assertSame(
            '<meta property="og:title" content="Hello World">',
            $meta->render()
        );
    }

    /** @test */
    public function it_can_set_name_property(): void
    {
        $meta = Meta::make('title', 'Hello World');

        $meta->setPrefix('og:');
        $meta->setNameProperty('property');

        static::assertSame(
            '<meta property="og:title" content="Hello World">',
            $meta->render()
        );
    }

    /** @test */
    public function it_must_throw_an_invalid_argument_exception_on_not_allowed_name(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The meta name property [foo] is not supported, the allowed name properties are ['charset', 'http-equiv', 'itemprop', 'name', 'property'].");

        Meta::make('title', 'Hello World')->setNameProperty('foo');
    }

    /** @test */
    public function it_can_render_array_content(): void
    {
        $meta = Meta::make('locale:alternate', ['fr_FR', 'es_ES', 'en_GB']);

        $meta->setPrefix('og:');
        $meta->setNameProperty('property');

        $expectations = [
            '<meta property="og:locale:alternate" content="fr_FR">',
            '<meta property="og:locale:alternate" content="en_GB">',
            '<meta property="og:locale:alternate" content="es_ES">',
        ];

        $actual = $meta->render();

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $actual);
        }
    }
}

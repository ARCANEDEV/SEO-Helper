<?php namespace Arcanedev\SeoHelper\Tests\Helpers;

use Arcanedev\SeoHelper\Helpers\Meta;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     MetaTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $results = [
            Meta::make('name', 'Hello world'),
            new Meta('name', 'Hello world'),
        ];
        $expectations = [
            \Arcanedev\SeoHelper\Helpers\Meta::class,
            \Arcanedev\SeoHelper\Contracts\Helpers\MetaInterface::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($results as $actual) {
            /** @var Meta $actual */
            foreach ($expectations as $expected) {
                $this->assertInstanceOf($expected, $actual);
            }

            $this->assertEquals('name', $actual->key());
            $this->assertTrue($actual->isValid());
        }
    }

    /** @test */
    public function it_can_valid()
    {
        $valids  = [
            Meta::make('name', 'Hello world')
        ];

        foreach ($valids as $meta) {
            /** @var Meta $meta */
            $this->assertTrue($meta->isValid());
        }

        $invalids = [
            Meta::make('name', ''),
            Meta::make('name', null),
            Meta::make('name', []),   // You shall not pass !
            Meta::make('name', true),
            Meta::make('name', 123),
        ];

        foreach ($invalids as $meta) {
            /** @var Meta $meta */
            $this->assertFalse($meta->isValid());
        }
    }

    /** @test */
    public function it_can_render()
    {
        $this->assertEquals(
            '<meta name="name" content="Hello world">',
            Meta::make('name', 'Hello world')->render()
        );

        $this->assertEquals(
            '<meta name="name" content="Hello world">',
            (string) Meta::make('name', 'Hello world')
        );

        $this->assertEquals(
            '<meta name="viewport" content="width=device-width, initial-scale=1">',
            Meta::make('viewport', 'width=device-width, initial-scale=1')->render()
        );

        $this->assertEquals(
            '<link rel="author" href="https://plus.google.com/+ArcanedevNetMaroc">',
            Meta::make('author', 'https://plus.google.com/+ArcanedevNetMaroc')->render()
        );
    }

    /** @test */
    public function it_can_make_meta_with_prefix()
    {
        $this->assertEquals(
            '<meta name="say:hello" content="Hello World">',
            Meta::make('hello', 'Hello World', 'say:')->render()
        );

        $meta = Meta::make('hello', 'Hello World');

        $this->assertEquals(
            '<meta name="say:hello" content="Hello World">',
            $meta->setPrefix('say:')->render()
        );
    }

    /** @test */
    public function it_can_clean_and_render()
    {
        $name    = '<b>Awesome name</b>';
        $content = 'Harmless <script>alert("Danger Zone");</script>';

        $this->assertEquals(
            '<meta name="Awesome-name" content="Harmless alert(&quot;Danger Zone&quot;);">',
            Meta::make($name, $content)->render()
        );
    }

    /** @test */
    public function it_can_make_meta_with_custom_name_property()
    {
        $this->assertEquals(
            '<meta property="og:title" content="Hello World">',
            Meta::make('title', 'Hello World', 'og:', 'property')->render()
        );
    }

    /** @test */
    public function it_can_set_name_property()
    {
        $meta = Meta::make('title', 'Hello World', 'og:');

        $this->assertEquals(
            '<meta property="og:title" content="Hello World">',
            $meta->setNameProperty('property')->render()
        );
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The meta name property is must be a string value, NULL is given.
     */
    public function it_must_throw_an_invalid_argument_exception_on_invalid_type()
    {
        Meta::make('title', 'Hello World')->setNameProperty(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The meta name property [foo] is not supported, the allowed name properties are ['name', 'property'].
     */
    public function it_must_throw_an_invalid_argument_exception_on_not_allowed_name()
    {
        Meta::make('title', 'Hello World')->setNameProperty('foo');
    }
}

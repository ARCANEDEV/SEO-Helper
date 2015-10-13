<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Meta;
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
            \Arcanedev\SeoHelper\Entities\Meta::class,
            \Arcanedev\SeoHelper\Contracts\Entities\MetaInterface::class,
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
            '<meta name="viewport" content="width=device-width, initial-scale=1">',
            Meta::make('viewport', 'width=device-width, initial-scale=1')->render()
        );

        $this->assertEquals(
            '<link rel="author" href="https://plus.google.com/+ArcanedevNetMaroc">',
            Meta::make('author', 'https://plus.google.com/+ArcanedevNetMaroc')->render()
        );
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\MetaCollection;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     MetaCollectionTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollectionTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection */
    private $metas;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->metas = new MetaCollection;
    }

    public function tearDown(): void
    {
        unset($this->metas);

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
            \Arcanedev\SeoHelper\Entities\MetaCollection::class,
            \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection::class,
            \Illuminate\Support\Collection::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->metas);
        }

        static::assertCount(0, $this->metas);
    }

    /** @test */
    public function it_can_add_meta(): void
    {
        $this->metas->addOne('robots', 'noindex, nofollow');

        static::assertCount(1, $this->metas);

        $this->metas->addOne('canonical', $this->baseUrl);

        static::assertCount(2, $this->metas);
    }

    /** @test */
    public function it_can_render_meta_tags(): void
    {
        $this->metas->addOne('robots', 'noindex, nofollow');

        $expected = '<meta name="robots" content="noindex, nofollow">';

        static::assertSame($expected, $this->metas->render());
        static::assertSame($expected, (string) $this->metas);
    }

    /** @test */
    public function it_can_render_link_tags(): void
    {
        $this->metas->addOne('canonical', $this->baseUrl);

        static::assertSame(
            '<link rel="canonical" href="'.$this->baseUrl.'">',
            $this->metas->render()
        );
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollection as MetaCollectionContract;
use Arcanedev\SeoHelper\Entities\MetaCollection;
use Arcanedev\SeoHelper\Tests\TestCase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;

/**
 * Class     MetaCollectionTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollectionTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private MetaCollectionContract $metas;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->metas = new MetaCollection();
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

    #[Test]
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            Collection::class,
            MetaCollectionContract::class,
            MetaCollection::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->metas);
        }

        static::assertCount(0, $this->metas);
    }

    #[Test]
    public function it_can_add_meta(): void
    {
        $this->metas->addOne('robots', 'noindex, nofollow');

        static::assertCount(1, $this->metas);

        $this->metas->addOne('canonical', $this->baseUrl);

        static::assertCount(2, $this->metas);
    }

    #[Test]
    public function it_can_render_meta_tags(): void
    {
        $this->metas->addOne('robots', 'noindex, nofollow');

        $expected = '<meta name="robots" content="noindex, nofollow">';

        static::assertSame($expected, $this->metas->render());
        static::assertSame($expected, (string) $this->metas);
    }

    #[Test]
    public function it_can_render_link_tags(): void
    {
        $this->metas->addOne('canonical', $this->baseUrl);

        static::assertSame(
            '<link rel="canonical" href="' . $this->baseUrl . '">',
            $this->metas->render()
        );
    }
}

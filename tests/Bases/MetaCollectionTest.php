<?php namespace Arcanedev\SeoHelper\Tests\Bases;

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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var MetaCollection */
    private $metas;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->metas = new MetaCollection;
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->metas);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(MetaCollection::class, $this->metas);
        $this->assertInstanceOf(\Arcanedev\Support\Collection::class, $this->metas);
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $this->metas);

        $this->assertCount(0, $this->metas);
    }

    /** @test */
    public function it_can_add_meta()
    {
        $this->metas->add('robots', 'noindex, nofollow');

        $this->assertCount(1, $this->metas);

        $this->metas->add('canonical', $this->baseUrl);

        $this->assertCount(2, $this->metas);
    }

    /** @test */
    public function it_can_render_meta_tags()
    {
        $this->metas->add('robots', 'noindex, nofollow');

        $this->assertEquals(
            '<meta name="robots" content="noindex, nofollow">',
            $this->metas->render()
        );
    }

    /** @test */
    public function it_can_render_link_tags()
    {
        $this->metas->add('canonical', $this->baseUrl);

        $this->assertEquals(
            '<link rel="canonical" href="' . $this->baseUrl . '">',
            $this->metas->render()
        );
    }
}

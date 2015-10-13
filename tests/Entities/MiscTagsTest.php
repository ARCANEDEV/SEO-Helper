<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\MiscTags;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     MiscTagsTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MiscTagsTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var MiscTags */
    private $misc;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config     = $this->getMiscConfig();
        $this->misc = new MiscTags($config);

        $this->misc->setUrl($this->baseUrl);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->misc);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(MiscTags::class,   $this->misc);
        $this->assertInstanceOf(Renderable::class, $this->misc);
    }

    /** @test */
    public function it_can_render_canonical()
    {
        $url = 'http://laravel.com';

        $this->misc->setUrl($url);

        $this->assertContains(
            '<link rel="canonical" href="' . $url . '">',
            $this->misc->render()
        );

        $this->misc = new MiscTags(['canonical' => false]);

        $this->assertEmpty($this->misc->render());
    }

    /** @test */
    public function it_can_render_robots()
    {
        $this->assertContains(
            '<meta name="robots" content="noindex, nofollow">',
            $this->misc->render()
        );

        $this->misc = new MiscTags(['robots' => false]);

        $this->assertEmpty($this->misc->render());
    }

    /** @test */
    public function it_can_render_author()
    {
        $author     = 'https://plus.google.com/+AuthorProfile';
        $this->misc = new MiscTags(['default' => compact('author')]);

        $this->assertEquals(
            '<link rel="author" href="' . $author . '">',
            $this->misc->render()
        );
    }

    /** @test */
    public function it_can_render_publisher()
    {
        $publisher  = 'https://plus.google.com/+PublisherProfile';
        $this->misc = new MiscTags(['default' => compact('publisher')]);

        $this->assertEquals(
            '<link rel="publisher" href="' . $publisher . '">',
            $this->misc->render()
        );
    }

    /** @test */
    public function it_can_render()
    {
        $robots     = '<meta name="robots" content="noindex, nofollow">';
        $canonical  = '<link rel="canonical" href="' . $this->baseUrl . '">';
        $viewport   = '<meta name="viewport" content="width=device-width, initial-scale=1">';

        $output = $this->misc->render();

        foreach (compact('robots', 'canonical', 'viewport') as $expected) {
            $this->assertContains($expected, $output);
        }

        $author     = 'https://plus.google.com/+AuthorProfile';
        $publisher  = 'https://plus.google.com/+PublisherProfile';

        $this->misc = new MiscTags(array_merge(
            $this->getMiscConfig(),
            ['default' => compact('author', 'publisher')]
        ));

        $this->assertEquals(implode(PHP_EOL, [
            $robots,
            '<link rel="author" href="' . $author . '">',
            '<link rel="publisher" href="' . $publisher . '">',
        ]), $this->misc->render());

        $this->misc->setUrl($this->baseUrl);

        $this->assertEquals(implode(PHP_EOL, [
            $robots,
            '<link rel="author" href="' . $author . '">',
            '<link rel="publisher" href="' . $publisher . '">',
            '<link rel="canonical" href="' . $this->baseUrl . '">',
        ]), $this->misc->render());
    }

    /** @test */
    public function it_can_add_and_remove_tags()
    {
        $this->assertNotEmpty($this->misc->render());

        $robots     = '<meta name="robots" content="noindex, nofollow">';
        $canonical  = '<link rel="canonical" href="' . $this->baseUrl . '">';
        $viewport   = '<meta name="viewport" content="width=device-width, initial-scale=1">';

        $output = $this->misc->render();

        foreach (compact('robots', 'canonical', 'viewport') as $expected) {
            $this->assertContains($expected, $output);
        }

        $this->misc->removeMeta('robots');

        $this->assertNotContains($robots, $this->misc->render());

        $this->misc->removeMeta('canonical');

        $this->assertNotContains($canonical, $this->misc->render());

        $this->misc->removeMeta('viewport');

        $this->assertEmpty($this->misc->render());

        $this->misc->addMeta('document-rating', 'Safe For Work');

        $this->assertEquals(
            '<meta name="document-rating" content="Safe For Work">',
            $this->misc->render()
        );

        $this->misc->removeMeta('document-rating');

        $this->assertEmpty($this->misc->render());

        $this->misc->addMetas([
            'copyright' => 'ARCANEDEV',
            'expires'   => 'never',
        ]);

        $output = $this->misc->render();

        $this->assertContains('<meta name="copyright" content="ARCANEDEV">', $output);
        $this->assertContains('<meta name="expires" content="never">', $output);

        $this->misc->removeMeta(['copyright', 'expires']);

        $this->assertEmpty($this->misc->render());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get misc config.
     *
     * @return array
     */
    private function getMiscConfig()
    {
        return $this->getSeoHelperConfig('misc', []);
    }
}

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
        $this->assertEquals(
            '<link rel="canonical" href="' . $this->baseUrl . '">',
            $this->misc->renderCanonical()
        );

        $url = 'http://laravel.com';

        $this->misc->setUrl($url);

        $this->assertEquals(
            '<link rel="canonical" href="' . $url . '">',
            $this->misc->renderCanonical()
        );

        $this->misc = new MiscTags(['canonical' => false]);

        $this->assertEmpty($this->misc->renderCanonical());
    }

    /** @test */
    public function it_can_render_robots()
    {
        $this->assertEquals(
            '<meta name="robots" content="noindex, nofollow">',
            $this->misc->renderRobots()
        );

        $this->misc = new MiscTags(['robots' => false]);

        $this->assertEmpty($this->misc->renderRobots());
    }

    /** @test */
    public function it_can_render_author()
    {
        $this->assertEmpty($this->misc->renderAuthor());

        $author     = 'https://plus.google.com/+AuthorProfile';
        $this->misc = new MiscTags(compact('author'));

        $this->assertEquals(
            '<meta name="author" content="' . $author . '">',
            $this->misc->renderAuthor()
        );
    }

    /** @test */
    public function it_can_render_publisher()
    {
        $this->assertEmpty($this->misc->renderPublisher());

        $publisher     = 'https://plus.google.com/+PublisherProfile';
        $this->misc = new MiscTags(compact('publisher'));

        $this->assertEquals(
            '<link rel="publisher" href="' . $publisher . '">',
            $this->misc->renderPublisher()
        );
    }

    /** @test */
    public function it_can_render()
    {
        $robots     = '<meta name="robots" content="noindex, nofollow">';
        $canonical  = '<link rel="canonical" href="' . $this->baseUrl . '">';

        $this->assertEquals(implode(PHP_EOL, [
            $robots, $canonical,
        ]), $this->misc->render());

        $author     = 'https://plus.google.com/+AuthorProfile';
        $publisher  = 'https://plus.google.com/+PublisherProfile';

        $this->misc = new MiscTags(array_merge(
            $this->getMiscConfig(),
            compact('author', 'publisher')
        ));

        $this->assertEquals(implode(PHP_EOL, [
            $robots,
            '<meta name="author" content="' . $author . '">',
            '<link rel="publisher" href="' . $publisher . '">',
        ]), $this->misc->render());

        $this->misc->setUrl($this->baseUrl);

        $this->assertEquals(implode(PHP_EOL, [
            $robots,
            '<meta name="author" content="' . $author . '">',
            '<link rel="publisher" href="' . $publisher . '">',
            '<link rel="canonical" href="' . $this->baseUrl . '">',
        ]), $this->misc->render());
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
        return array_get($this->config()->get('seo-helper'), 'misc', []);
    }
}

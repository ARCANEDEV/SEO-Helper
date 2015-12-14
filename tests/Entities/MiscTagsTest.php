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
        unset($this->misc);

        parent::tearDown();
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

        $expected = '<link rel="canonical" href="' . $url . '">';

        $this->assertContains($expected, $this->misc->render());
        $this->assertContains($expected, (string) $this->misc);

        $this->misc = new MiscTags(['canonical' => false]);

        $this->assertEmpty($this->misc->render());
        $this->assertEmpty((string) $this->misc);
    }

    /** @test */
    public function it_can_render_robots()
    {
        $expected = '<meta name="robots" content="noindex, nofollow">';

        $this->assertContains($expected, $this->misc->render());
        $this->assertContains($expected, (string) $this->misc);

        $this->misc = new MiscTags(['robots' => false]);

        $this->assertEmpty($this->misc->render());
        $this->assertEmpty((string) $this->misc);
    }

    /** @test */
    public function it_can_render_links()
    {
        $author     = 'https://plus.google.com/+AuthorProfile';
        $publisher  = 'https://plus.google.com/+PublisherProfile';

        $this->misc = new MiscTags([
            'default' => compact('author', 'publisher')
        ]);

        $expectations = [
            '<link rel="author" href="' . $author . '">',
            '<link rel="publisher" href="' . $publisher . '">',
        ];

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->misc->render());
            $this->assertContains($expected, (string) $this->misc);
        }
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
    public function it_can_add_remove_and_reset_tags()
    {
        $this->assertNotEmpty($this->misc->render());

        $robots     = '<meta name="robots" content="noindex, nofollow">';
        $canonical  = '<link rel="canonical" href="' . $this->baseUrl . '">';
        $viewport   = '<meta name="viewport" content="width=device-width, initial-scale=1">';

        $output = $this->misc->render();

        foreach (compact('robots', 'canonical', 'viewport') as $expected) {
            $this->assertContains($expected, $output);
        }

        $this->misc->remove('robots');

        $this->assertNotContains($robots, $this->misc->render());

        $this->misc->remove('canonical');

        $this->assertNotContains($canonical, $this->misc->render());

        $this->misc->remove('viewport');

        $this->assertEmpty($this->misc->render());

        $this->misc->add('document-rating', 'Safe For Work');

        $this->assertEquals(
            '<meta name="document-rating" content="Safe For Work">',
            $this->misc->render()
        );

        $this->misc->remove('document-rating');

        $this->assertEmpty($this->misc->render());

        $this->misc->addMany([
            'copyright' => 'ARCANEDEV',
            'expires'   => 'never',
        ]);

        $output = $this->misc->render();

        $this->assertContains('<meta name="copyright" content="ARCANEDEV">', $output);
        $this->assertContains('<meta name="expires" content="never">', $output);

        $this->misc->remove(['copyright', 'expires']);

        $this->assertEmpty($this->misc->render());

        $this->misc->addMany([
            'document-rating' => 'Safe For Work',
            'copyright'       => 'ARCANEDEV',
            'expires'         => 'never',
        ]);

        $this->assertNotEmpty($this->misc->render());

        $this->misc->reset();

        $this->assertEmpty($this->misc->render());
    }

    /** @test */
    public function it_can_make()
    {
        $this->misc = MiscTags::make([
            'copyright'       => 'ARCANEDEV',
            'document-rating' => 'Safe For Work',
            'expires'         => 'expires',
        ]);

        $copyright    = '<meta name="copyright" content="ARCANEDEV">';
        $expectations = [
            $copyright,
            '<meta name="document-rating" content="Safe For Work">',
            '<meta name="expires" content="expires">',
        ];

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->misc->render());
            $this->assertContains($expected, (string) $this->misc);
        }

        $this->misc->remove(['expires', 'document-rating']);

        $this->assertEquals($copyright, $this->misc->render());
        $this->assertEquals($copyright, (string) $this->misc);
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

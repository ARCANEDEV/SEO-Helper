<?php namespace Arcanedev\SeoHelper\Tests\Entities\OpenGraph;

use Arcanedev\SeoHelper\Entities\OpenGraph\Graph;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     GraphTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities\OpenGraph
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GraphTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Graph */
    private $og;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config   = $this->getSeoHelperConfig('open-graph');
        $this->og = new Graph($config);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->og);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Entities\OpenGraph\Graph::class,
            \Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->og);
        }
    }

    /** @test */
    public function it_can_render_defaults()
    {
        $output       = $this->og->render();
        $expectations = [
            '<meta property="og:type" content="website">',
            '<meta property="og:title" content="Default Open Graph title">',
            '<meta property="og:description" content="Default Open Graph description">',
        ];

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $output);
        }
    }

    /** @test */
    public function it_can_set_and_render_type()
    {
        $types = [
            'article',
            'video',
            'video.movie',
            'video.episode',
        ];

        foreach ($types as $type) {
            $this->og->setType($type);

            $this->assertContains(
                '<meta property="og:type" content="' . $type . '">',
                $this->og->render()
            );
        }
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $title = 'Hello World';

        $this->og->setTitle($title);

        $this->assertContains(
            '<meta property="og:title" content="' . $title . '">',
            $this->og->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $description = 'Hello World detailed description.';

        $this->og->setDescription($description);

        $this->assertContains(
            '<meta property="og:description" content="' . $description . '">',
            $this->og->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_url()
    {
        $url = 'http://www.imdb.com/title/tt0080339/';

        $this->og->setUrl($url);

        $this->assertContains(
            '<meta property="og:url" content="' . $url . '">',
            $this->og->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_image()
    {
        $image = 'http://ia.media-imdb.com/images/M/MV5BNDU2MjE4MTcwNl5BMl5BanBnXkFtZTgwNDExOTMxMDE@._V1_UY1200_CR90,0,630,1200_AL_.jpg';

        $this->og->setImage($image);

        $this->assertContains(
            '<meta property="og:image" content="' . $image . '">',
            $this->og->render()
        );
    }
}

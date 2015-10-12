<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\Keywords;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     KeywordsTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class KeywordsTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Keywords */
    private $keywords;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config         = $this->getKeywordsConfig();
        $this->keywords = new Keywords($config);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->keywords);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Keywords::class,   $this->keywords);
        $this->assertInstanceOf(Renderable::class, $this->keywords);
    }

    /** @test */
    public function it_can_get_default_content()
    {
        $content = $this->getDefaultContent();

        $this->assertEquals($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_set_and_get_content()
    {
        $content = $this->getDefaultContent();

        $this->keywords->setContent($content);

        $this->assertEquals($content, $this->keywords->getContent());

        $this->keywords->setContent(implode(',', $content));

        $this->assertEquals($content, $this->keywords->getContent());

        $keyword = 'one-keyword';
        $this->keywords->setContent($keyword);

        $this->assertEquals([$keyword], $this->keywords->getContent());

        $this->keywords->setContent(null);

        $this->assertEmpty($this->keywords->getContent());
    }

    /** @test */
    public function it_can_render()
    {
        $content  = $this->getDefaultContent();
        $expected = '<meta name="keywords" content="' . implode(', ', $content) .'">';

        $this->assertEquals($expected, $this->keywords->render());

        $this->keywords->setContent(implode(',', $content));

        $this->assertEquals($expected, $this->keywords->render());

        $this->keywords->setContent(implode(' ,', $content));

        $this->assertEquals($expected, $this->keywords->render());

        $this->keywords->setContent(implode(', ', $content));

        $this->assertEquals($expected, $this->keywords->render());

        $this->keywords->setContent(implode(' , ', $content));

        $this->assertEquals($expected, $this->keywords->render());

        $this->keywords->setContent(null);

        $this->assertEmpty($this->keywords->render());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get keywords config.
     *
     * @return array
     */
    private function getKeywordsConfig()
    {
        return $this->config()->get('seo-helper.keywords', []);
    }

    /**
     * Get keywords default content.
     *
     * @return array|string
     */
    private function getDefaultContent()
    {
        return array_get($this->getKeywordsConfig(), 'default', []);
    }
}

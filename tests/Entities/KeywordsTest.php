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

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_set_and_get_content()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());

        $this->keywords->set(implode(',', $content));

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());

        $keyword = 'one-keyword';
        $this->keywords->set($keyword);

        $this->assertCount(1, $this->keywords->getContent());
        $this->assertEquals([$keyword], $this->keywords->getContent());

        $this->keywords->set(null);

        $this->assertCount(0, $this->keywords->getContent());
        $this->assertEmpty($this->keywords->getContent());
    }

    /** @test */
    public function it_can_add_a_keyword()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());

        $content[] = $keyword = 'keyword-6';
        $this->keywords->add($keyword);

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_add_many_keywords()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());

        $keywords = ['keyword-6', 'keyword-7', 'keyword-8'];
        $content  = array_merge($content, $keywords);

        $this->keywords->addMany($keywords);

        $this->assertCount(count($content), $this->keywords->getContent());
        $this->assertEquals($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_render()
    {
        $content  = $this->getDefaultContent();
        $expected = '<meta name="keywords" content="' . implode(', ', $content) .'">';

        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);

        $this->keywords->set(implode(',', $content));

        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);

        $this->keywords->set(implode(' ,', $content));

        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);

        $this->keywords->set(implode(', ', $content));

        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);

        $this->keywords->set(implode(' , ', $content));

        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);

        $this->keywords->set(null);

        $this->assertEmpty($this->keywords->render());
        $this->assertEmpty((string) $this->keywords);
    }

    /** @test */
    public function it_can_make()
    {
        $keywords       = $this->getDefaultContent();
        $this->keywords = Keywords::make($keywords);

        $expected       = '<meta name="keywords" content="' . implode(', ', $keywords) .'">';

        $this->assertEquals($keywords, $this->keywords->getContent());
        $this->assertEquals($expected, $this->keywords->render());
        $this->assertEquals($expected, (string) $this->keywords);
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
        return $this->getSeoHelperConfig('keywords', []);
    }

    /**
     * Get keywords default content.
     *
     * @return array|string
     */
    private function getDefaultContent()
    {
        return $this->getSeoHelperConfig('keywords.default', []);
    }
}

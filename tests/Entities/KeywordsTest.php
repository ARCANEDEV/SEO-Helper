<?php namespace Arcanedev\SeoHelper\Tests\Entities;

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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\Keywords */
    private $keywords;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $config         = $this->getKeywordsConfig();
        $this->keywords = new Keywords($config);
    }

    public function tearDown(): void
    {
        unset($this->keywords);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\Contracts\Entities\Keywords::class,
            Keywords::class
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected,   $this->keywords);
        }
    }

    /** @test */
    public function it_can_get_default_content()
    {
        $content = $this->getDefaultContent();

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_set_and_get_content()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());

        $this->keywords->set(implode(',', $content));

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());

        $keyword = 'one-keyword';
        $this->keywords->set($keyword);

        static::assertCount(1, $this->keywords->getContent());
        static::assertSame([$keyword], $this->keywords->getContent());

        $this->keywords->set(null);

        static::assertCount(0, $this->keywords->getContent());
        static::assertEmpty($this->keywords->getContent());
    }

    /** @test */
    public function it_can_add_a_keyword()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());

        $content[] = $keyword = 'keyword-6';
        $this->keywords->add($keyword);

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_add_many_keywords()
    {
        $content = $this->getDefaultContent();

        $this->keywords->set($content);

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());

        $keywords = ['keyword-6', 'keyword-7', 'keyword-8'];
        $content  = array_merge($content, $keywords);

        $this->keywords->addMany($keywords);

        static::assertCount(count($content), $this->keywords->getContent());
        static::assertSame($content, $this->keywords->getContent());
    }

    /** @test */
    public function it_can_render()
    {
        $content  = $this->getDefaultContent();
        $expected = '<meta name="keywords" content="'.implode(', ', $content).'">';

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());

        $this->keywords->set(implode(',', $content));

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());

        $this->keywords->set(implode(' ,', $content));

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());

        $this->keywords->set(implode(', ', $content));

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());

        $this->keywords->set(implode(' , ', $content));

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());

        $this->keywords->set(null);

        static::assertEmpty((string) $this->keywords);
        static::assertEmpty($this->keywords->render());
    }

    /** @test */
    public function it_can_make()
    {
        $keywords       = $this->getDefaultContent();
        $this->keywords = Keywords::make($keywords);

        static::assertSame($keywords, $this->keywords->getContent());

        $expected = '<meta name="keywords" content="'.implode(', ', $keywords).'">';

        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords);
        static::assertHtmlStringEqualsHtmlString($expected, $this->keywords->render());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
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

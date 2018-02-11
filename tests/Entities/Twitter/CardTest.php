<?php namespace Arcanedev\SeoHelper\Tests\Entities\Twitter;

use Arcanedev\SeoHelper\Entities\Twitter\Card;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     CardTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities\Twitter
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CardTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\SeoHelper\Contracts\Entities\Twitter\Card */
    private $card;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $config     = $this->getSeoHelperConfig('twitter');
        $this->card = new Card($config);
    }

    public function tearDown()
    {
        unset($this->card);

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
            \Arcanedev\SeoHelper\Entities\Twitter\Card::class,
            \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->card);
        }
    }

    /** @test */
    public function it_can_set_type_and_render()
    {
        $supported = [
            'app', 'gallery', 'photo', 'player', 'product', 'summary', 'summary_large_image'
        ];

        foreach ($supported as $type) {
            $this->card->setType($type);

            $expected = '<meta name="twitter:card" content="'.$type.'">';

            static::assertContains($expected, $this->card->render());
            static::assertContains($expected, (string) $this->card);
        }
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException
     * @expectedExceptionMessage  The Twitter card type must be a string value, [boolean] was given.
     */
    public function it_must_throw_invalid_twitter_card_exception_on_invalid_type()
    {
        $this->card->setType(true);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException
     * @expectedExceptionMessage  The Twitter card type [selfie] is not supported.
     */
    public function it_must_throw_invalid_twitter_card_exception_on_unsupported_type()
    {
        $this->card->setType('selfie');
    }

    /** @test */
    public function it_can_set_prefix()
    {
        $prefix     = 'twt:';
        $this->card = new Card([
            'prefix' => $prefix,
            'card'   => 'summary',
        ]);

        $expected   = '<meta name="'.$prefix.'card" content="summary">';

        static::assertContains($expected, $this->card->render());
        static::assertContains($expected, (string) $this->card);
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $title = 'Hello world';
        $this->card->setTitle($title);

        $expected = '<meta name="twitter:title" content="'.$title.'">';

        static::assertContains($expected, $this->card->render());
        static::assertContains($expected, (string) $this->card);
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $description = 'Hello world description';
        $this->card->setDescription($description);

        $expected = '<meta name="twitter:description" content="'.$description.'">';

        static::assertContains($expected, $this->card->render());
        static::assertContains($expected, (string) $this->card);
    }

    /** @test */
    public function it_can_set_and_render_site()
    {
        $site     = 'Arcanedev';
        $excepted = '<meta name="twitter:site" content="@'.$site.'">';

        $this->card->setSite('@'.$site);

        static::assertContains($excepted, $this->card->render());
        static::assertContains($excepted, (string) $this->card);

        $this->card->setSite($site);

        static::assertContains($excepted, $this->card->render());
        static::assertContains($excepted, (string) $this->card);
    }

    /** @test */
    public function it_can_add_and_render_one_image()
    {
        $avatar   = 'http://example.com/img/avatar.png';
        $this->card->addImage($avatar);
        $expected = '<meta name="twitter:image" content="'.$avatar.'">';

        static::assertContains($expected, $this->card->render());
        static::assertContains($expected, (string) $this->card);
    }

    /** @test */
    public function it_can_add_and_render_multiple_images()
    {
        $avatar = 'http://example.com/img/avatar.png';
        $number = range(0, 4);

        for ($i = 0; $i < count($number); $i++) {
            $this->card->addImage($avatar);
        }

        $output = $this->card->render();

        foreach (range(0, 3) as $expected) {
            static::assertContains('twitter:image'.$expected, $output);
        }

        static::assertNotContains('twitter:image4', $output);
    }

    /** @test */
    public function it_can_add_and_render_many_metas()
    {
        $metas = [
            'creator' => '@Arcanedev',
            'url'     => 'http://www.arcanedev.net',
        ];

        $expectations = [];

        foreach ($metas as $name => $content) {
            $expectations[] = '<meta name="twitter:'.$name.'" content="'.$content.'">';
        }

        $this->card->addMetas($metas);

        foreach ($expectations as $expected) {
            static::assertContains($expected, $this->card->render());
            static::assertContains($expected, (string) $this->card);
        }
    }

    /** @test */
    public function it_can_reset()
    {
        $expected = $this->card->render();

        $this->card->setType('app');
        $this->card->setDescription('Twitter card description');
        $this->card->addImage('http://example.com/img/avatar.png');

        static::assertNotSame($expected, $this->card->render());
        static::assertNotSame($expected, (string) $this->card);

        $this->card->reset();

        static::assertSame($expected, $this->card->render());
        static::assertSame($expected, (string) $this->card);
    }
}

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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Card */
    private $card;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config     = $this->getSeoHelperConfig('twitter');
        $this->card = new Card($config);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->card);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Entities\Twitter\Card::class,
            \Arcanedev\SeoHelper\Contracts\Entities\TwitterCardInterface::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->card);
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

            $this->assertContains(
                '<meta name="twitter:card" content="' . $type . '">',
                $this->card->render()
            );
        }
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException
     * @expectedExceptionMessage  The Twitter card type must be a string value, [NULL] was given.
     */
    public function it_must_throw_invalid_twitter_card_exception_on_invalid_type()
    {
        $this->card->setType(null);
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
        $this->card = new Card(['prefix' => $prefix]);

        $this->assertContains(
            '<meta name="' . $prefix . 'card" content="summary">',
            $this->card->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $title = 'Hello world';
        $this->card->setTitle($title);

        $this->assertContains(
            '<meta name="twitter:title" content="' . $title . '">',
            $this->card->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $description = 'Hello world description';
        $this->card->setDescription($description);

        $this->assertContains(
            '<meta name="twitter:description" content="' . $description . '">',
            $this->card->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_site()
    {
        $site     = 'Arcanedev';
        $excepted = '<meta name="twitter:site" content="@' . $site . '">';

        $this->card->setSite('@' . $site);

        $this->assertContains($excepted, $this->card->render());

        $this->card->setSite($site);

        $this->assertContains($excepted, $this->card->render());
    }

    /** @test */
    public function it_can_add_and_render_one_image()
    {
        $avatar = 'http://example.com/img/avatar.png';

        $this->card->addImage($avatar);

        $this->assertContains(
            '<meta name="twitter:image" content="' . $avatar . '">',
            $this->card->render()
        );
    }

    /** @test */
    public function it_can_add_and_render_multiple_images()
    {
        $avatar = 'http://example.com/img/avatar.png';
        $number = range(0, 4);

        foreach ($number as $v) {
            $this->card->addImage($avatar);
        }

        $output = $this->card->render();

        foreach (range(0, 3) as $expected) {
            $this->assertContains('twitter:image' . $expected, $output);
        }

        $this->assertNotContains('twitter:image4', $output);
    }

    /** @test */
    public function it_can_reset()
    {
        $expected = $this->card->render();

        $this->card->setType('app');
        $this->card->setDescription('Twitter card description');
        $this->card->addImage('http://example.com/img/avatar.png');

        $this->assertNotEquals($expected, $this->card->render());

        $this->card->reset();

        $this->assertEquals($expected, $this->card->render());
    }
}

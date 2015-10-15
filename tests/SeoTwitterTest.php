<?php namespace Arcanedev\SeoHelper\Tests;

use Arcanedev\SeoHelper\SeoTwitter;

/**
 * Class     SeoTwitterTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoTwitterTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoTwitter */
    private $twitter;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs          = $this->getSeoHelperConfig();
        $this->twitter = new SeoTwitter($configs);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->twitter);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\SeoTwitter::class,
            \Arcanedev\SeoHelper\Contracts\SeoTwitter::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->twitter);
        }
    }

    /** @test */
    public function it_can_render_defaults()
    {
        $output = $this->twitter->render();

        $expectations = [
            '<meta name="twitter:card" content="summary">',
            '<meta name="twitter:site" content="@Username">',
            '<meta name="twitter:title" content="Default title">',
        ];

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $output);
        }
    }

    /** @test */
    public function it_can_set_and_render_type()
    {
        $this->twitter->setType('app');

        $this->assertContains(
            '<meta name="twitter:card" content="app">',
            $this->twitter->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_site()
    {
        $this->twitter->setSite('Arcanedev');

        $this->assertContains(
            '<meta name="twitter:site" content="@Arcanedev">',
            $this->twitter->render()
        );
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $this->twitter->setTitle('Arcanedev super title');

        $this->assertContains(
            '<meta name="twitter:title" content="Arcanedev super title">',
            $this->twitter->render()
        );
    }

    /** @test */
    public function it_can_add_and_render_image()
    {
        $this->twitter->addImage('http://example.com/img/avatar.png');

        $this->assertContains(
            '<meta name="twitter:image" content="http://example.com/img/avatar.png">',
            $this->twitter->render()
        );
    }

    /** @test */
    public function it_can_reset_card()
    {
        $expected = $this->twitter->render();

        $this->twitter->setType('app');
        $this->twitter->setSite('Arcanedev');
        $this->twitter->setTitle('Arcanedev super title');
        $this->twitter->addImage('http://example.com/img/avatar.png');

        $this->assertNotEquals($expected, $this->twitter->render());

        $this->twitter->reset();

        $this->assertEquals($expected, $this->twitter->render());
    }

    /** @test */
    public function it_can_add_and_render_a_meta()
    {
        $this->twitter->addMeta('creator', '@Arcanedev');

        $this->assertContains(
            '<meta name="twitter:creator" content="@Arcanedev">',
            $this->twitter->render()
        );
    }
}

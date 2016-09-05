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
    private $seoTwitter;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs          = $this->getSeoHelperConfig();
        $this->seoTwitter = new SeoTwitter($configs);
    }

    public function tearDown()
    {
        unset($this->seoTwitter);

        parent::tearDown();
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
            $this->assertInstanceOf($expected, $this->seoTwitter);
        }
    }

    /** @test */
    public function it_can_render_defaults()
    {
        $output = $this->seoTwitter->render();

        $expectations = [
            '<meta name="twitter:card" content="summary">',
            '<meta name="twitter:site" content="@Username">',
            '<meta name="twitter:title" content="Default Twitter Card title">',
        ];

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $output);
        }
    }

    /** @test */
    public function it_can_set_and_render_type()
    {
        $this->seoTwitter->setType('app');

        $expected = '<meta name="twitter:card" content="app">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
    }

    /** @test */
    public function it_can_set_and_render_site()
    {
        $this->seoTwitter->setSite('Arcanedev');

        $expected = '<meta name="twitter:site" content="@Arcanedev">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
    }

    /** @test */
    public function it_can_set_and_render_title()
    {
        $this->seoTwitter->setTitle('ARCANEDEV super title');

        $expected = '<meta name="twitter:title" content="ARCANEDEV super title">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
    }

    /** @test */
    public function it_can_set_and_render_description()
    {
        $this->seoTwitter->setDescription('ARCANEDEV super description');

        $expected = '<meta name="twitter:description" content="ARCANEDEV super description">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
    }

    /** @test */
    public function it_can_add_and_render_image()
    {
        $this->seoTwitter->addImage('http://example.com/img/avatar.png');

        $expected = '<meta name="twitter:image" content="http://example.com/img/avatar.png">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
    }

    /** @test */
    public function it_can_reset_card()
    {
        $expected = $this->seoTwitter->render();

        $this->seoTwitter->setType('app');
        $this->seoTwitter->setSite('Arcanedev');
        $this->seoTwitter->setTitle('Arcanedev super title');
        $this->seoTwitter->addImage('http://example.com/img/avatar.png');

        $this->assertNotSame($expected, $this->seoTwitter->render());

        $this->seoTwitter->reset();

        $this->assertSame($expected, $this->seoTwitter->render());
    }

    /** @test */
    public function it_can_add_and_render_a_meta()
    {
        $this->seoTwitter->addMeta('creator', '@Arcanedev');

        $expected = '<meta name="twitter:creator" content="@Arcanedev">';

        $this->assertContains($expected, $this->seoTwitter->render());
        $this->assertContains($expected, (string) $this->seoTwitter);
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
            $expectations[] = '<meta name="twitter:' . $name . '" content="' . $content . '">';
        }

        $this->seoTwitter->addMetas($metas);

        foreach ($expectations as $expected) {
            $this->assertContains($expected, $this->seoTwitter->render());
            $this->assertContains($expected, (string) $this->seoTwitter);
        }
    }

    /** @test */
    public function it_can_enable_and_disable()
    {
        $this->assertTrue($this->seoTwitter->isEnabled());
        $this->assertFalse($this->seoTwitter->isDisabled());
        $this->assertNotEmpty($this->seoTwitter->render());

        $this->seoTwitter->disable();

        $this->assertFalse($this->seoTwitter->isEnabled());
        $this->assertTrue($this->seoTwitter->isDisabled());
        $this->assertEmpty($this->seoTwitter->render());

        $this->seoTwitter->enable();

        $this->assertTrue($this->seoTwitter->isEnabled());
        $this->assertFalse($this->seoTwitter->isDisabled());
        $this->assertNotEmpty($this->seoTwitter->render());
    }
}

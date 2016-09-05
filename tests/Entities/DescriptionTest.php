<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Description;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     DescriptionTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DescriptionTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Description */
    private $description;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $config            = $this->getDescriptionConfig();
        $this->description = new Description($config);
    }

    public function tearDown()
    {
        unset($this->description);

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
            \Arcanedev\SeoHelper\Entities\Description::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\Contracts\Entities\Description::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->description);
        }
    }

    /** @test */
    public function it_can_make()
    {
        $this->description = Description::make('Cool description about this package');

        $expectations = [
            \Arcanedev\SeoHelper\Entities\Description::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
            \Arcanedev\SeoHelper\Contracts\Entities\Description::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->description);
        }
    }

    /** @test */
    public function it_can_get_default_description()
    {
        $content = $this->getDefaultContent();

        $this->assertSame($content, $this->description->getContent());
    }

    /** @test */
    public function it_can_set_and_get_content()
    {
        $content = 'Cool description about this package';

        $this->description->set($content);

        $this->assertSame($content, $this->description->getContent());
    }

    /** @test */
    public function it_can_set_and_get_max_length()
    {
        $max = 150;

        $this->description->setMax($max);

        $this->assertSame($max, $this->description->getMax());
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The description maximum lenght must be integer.
     */
    public function it_must_throw_invalid_max_lenght_type()
    {
        $this->description->setMax(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage  The description maximum lenght must be greater 0.
     */
    public function it_must_throw_invalid_max_lenght_value()
    {
        $this->description->setMax(0);
    }

    /** @test */
    public function it_can_render()
    {
        $description = 'Cool description about this package';

        $this->description->set($description);

        $expected = '<meta name="description" content="' . $description .'">';

        $this->assertSame($expected, $this->description->render());
        $this->assertSame($expected, (string) $this->description);
    }

    /** @test */
    public function it_can_render_empty_description()
    {
        $this->description->set('');

        $this->assertEmpty($this->description->render());
        $this->assertEmpty((string) $this->description);
    }

    /** @test */
    public function it_can_render_long_title()
    {
        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ullamco laboris aliquip commodo.';
        $max     = $this->getDefaultMax();

        $this->description->set($content)->setMax($max);

        $expected = '<meta name="description" content="' . str_limit($content, $max) . '">';

        $this->assertSame($expected, $this->description->render());
        $this->assertSame($expected, (string) $this->description);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get description config.
     *
     * @return array
     */
    private function getDescriptionConfig()
    {
        return $this->getSeoHelperConfig('description', []);
    }

    /**
     * Get default description content.
     *
     * @param  string  $default
     *
     * @return string
     */
    private function getDefaultContent($default = '')
    {
        return $this->getSeoHelperConfig('description.default', $default);
    }

    /**
     * Get default description max length.
     *
     * @param  int  $default
     *
     * @return int
     */
    private function getDefaultMax($default = 155)
    {
        return $this->getSeoHelperConfig('description.max', $default);
    }
}

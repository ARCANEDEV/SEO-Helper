<?php namespace Arcanedev\SeoHelper\Tests\Entities;
use Arcanedev\SeoHelper\Contracts\Renderable;
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
        parent::tearDown();

        unset($this->description);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Description::class,   $this->description);
        $this->assertInstanceOf(Renderable::class, $this->description);
    }

    /** @test */
    public function it_can_get_default_description()
    {
        $content = $this->getDefaultContent();
        $this->assertEquals($content, $this->description->getContent());
    }

    /** @test */
    public function it_can_set_and_get_content()
    {
        $content = 'Cool description about this package';

        $this->description->setContent($content);

        $this->assertEquals($content, $this->description->getContent());
    }

    /** @test */
    public function it_can_set_and_get_max_length()
    {
        $max = 150;

        $this->description->setMax($max);

        $this->assertEquals($max, $this->description->getMax());
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

        $this->description->setContent($description);

        $this->assertEquals(
            '<meta name="description" content="' . $description .'">',
            $this->description->render()
        );
    }

    /** @test */
    public function it_can_render_empty_description()
    {
        $this->description->setContent('');

        $this->assertEmpty($this->description->render());
    }

    /** @test */
    public function it_can_render_long_title()
    {
        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ullamco laboris aliquip commodo.';
        $max     = $this->getDefaultMax();

        $this->description->setContent($content)->setMax($max);

        $this->assertEquals(
            '<meta name="description" content="' . str_limit($content, $max) . '">',
            $this->description->render()
        );
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
        return $this->config()->get('seo-helper.description');
    }

    /**
     * Get default description content.
     *
     * @return string
     */
    private function getDefaultContent()
    {
        return array_get($this->getDescriptionConfig(), 'default', '');
    }

    /**
     * Get default description max length.
     *
     * @return int
     */
    private function getDefaultMax()
    {
        return array_get($this->getDescriptionConfig(), 'max', 155);
    }
}

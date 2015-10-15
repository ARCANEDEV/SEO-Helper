<?php namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Entities\Webmasters;
use Arcanedev\SeoHelper\Tests\TestCase;

/**
 * Class     WebmastersTest
 *
 * @package  Arcanedev\SeoHelper\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class WebmastersTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Webmasters */
    private $webmasters;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs          = $this->getSeoHelperConfig('webmasters');
        $this->webmasters = new Webmasters($configs);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->webmasters);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\SeoHelper\Entities\Webmasters::class,
            \Arcanedev\SeoHelper\Contracts\Entities\WebmastersInterface::class,
            \Arcanedev\SeoHelper\Contracts\Renderable::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->webmasters);
        }
    }

    /** @test */
    public function it_can_render_defaults()
    {
        $expectations = [
            '<meta name="google-site-verification" content="site-verification-code">',
            '<meta name="msvalidate.01" content="site-verification-code">',
            '<meta name="alexaVerifyID" content="site-verification-code">',
            '<meta name="p:domain_verify" content="site-verification-code">',
            '<meta name="yandex-verification" content="site-verification-code">',
        ];

        foreach ($expectations as $excepted) {
            $this->assertContains($excepted, $this->webmasters->render());
            $this->assertContains($excepted, (string) $this->webmasters);
        }
    }

    /** @test */
    public function it_can_skip_unsupported_webmasters()
    {
        $this->webmasters = new Webmasters([
            'duckduckgo'  => 'site-verification-code'
        ]);

        $this->assertEmpty($this->webmasters->render());
    }
}

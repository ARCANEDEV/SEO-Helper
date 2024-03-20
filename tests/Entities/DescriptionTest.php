<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\Description;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

/**
 * Class     DescriptionTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DescriptionTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    private DescriptionContract $description;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->description = new Description(
            $this->getDescriptionConfig()
        );
    }

    public function tearDown(): void
    {
        unset($this->description);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    #[Test]
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            Renderable::class,
            DescriptionContract::class,
            Description::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->description);
        }
    }

    #[Test]
    public function it_can_make(): void
    {
        $this->description = Description::make('Cool description about this package');

        $expectations = [
            Renderable::class,
            DescriptionContract::class,
            Description::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->description);
        }
    }

    #[Test]
    public function it_can_get_default_description(): void
    {
        $content = $this->getDefaultContent();

        static::assertSame($content, $this->description->getContent());
    }

    #[Test]
    public function it_can_set_and_get_content(): void
    {
        $content = 'Cool description about this package';

        $this->description->set($content);

        static::assertSame($content, $this->description->getContent());
    }

    #[Test]
    public function it_can_set_and_get_max_length(): void
    {
        $max = 150;

        $this->description->setMax($max);

        static::assertSame($max, $this->description->getMax());
    }

    #[Test]
    public function it_must_throw_invalid_max_length_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The description maximum length must be greater 0.');

        $this->description->setMax(0);
    }

    #[Test]
    public function it_can_render(): void
    {
        $this->description->set(
            $description = 'Cool description about this package'
        );

        $expected = '<meta name="description" content="' . $description . '">';

        static::assertHtmlStringEqualsHtmlString($expected, $this->description);
        static::assertHtmlStringEqualsHtmlString($expected, $this->description->render());
    }

    #[Test]
    public function it_can_render_empty_description(): void
    {
        $this->description->set('');

        static::assertEmpty($this->description->render());
        static::assertEmpty((string) $this->description);
    }

    #[Test]
    public function it_can_render_long_title(): void
    {
        $content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ullamco laboris aliquip commodo.';
        $max     = $this->getDefaultMax();

        $this->description->set($content)->setMax($max);

        $expected = '<meta name="description" content="' . Str::limit($content, $max) . '">';

        static::assertHtmlStringEqualsHtmlString($expected, $this->description);
        static::assertHtmlStringEqualsHtmlString($expected, $this->description->render());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get description config.
     */
    private function getDescriptionConfig(): array
    {
        return $this->getSeoHelperConfig('description', []);
    }

    /**
     * Get default description content.
     */
    private function getDefaultContent(string $default = ''): string
    {
        return $this->getSeoHelperConfig('description.default', $default);
    }

    /**
     * Get default description max length.
     */
    private function getDefaultMax(int $default = 155): int
    {
        return $this->getSeoHelperConfig('description.max', $default);
    }
}

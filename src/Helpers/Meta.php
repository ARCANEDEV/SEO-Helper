<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Helpers;

use Arcanedev\Html\Elements\HtmlElement;
use Arcanedev\Html\Elements\Meta as HtmlMeta;
use Arcanedev\SeoHelper\Contracts\Helpers\Meta as MetaContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Illuminate\Support\{Arr, Str};

/**
 * Class     Meta
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Meta implements MetaContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Meta prefix name.
     */
    protected string $prefix = '';

    /**
     * The meta name property.
     */
    protected string $nameProperty = 'name';

    /**
     * Meta name.
     */
    protected string $name = '';

    /**
     * Meta content.
     */
    protected string|array $content;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     */
    public function __construct(string $name, array|string $content, string $propertyName = 'name', string $prefix = '')
    {
        $this->setPrefix($prefix);
        $this->setName($name);
        $this->setContent($content);
        $this->setNameProperty($propertyName);
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     *
     * @return $this
     */
    public static function make(string $name, array|string $content, string $propertyName = 'name', string $prefix = ''): static
    {
        return new static($name, $content, $propertyName, $prefix);
    }

    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the meta name.
     */
    public function key(): string
    {
        return $this->name;
    }

    /**
     * Set the meta prefix name.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Set the meta property name.
     *
     * @return $this
     */
    public function setNameProperty(string $nameProperty): static
    {
        $this->checkNameProperty($nameProperty);
        $this->nameProperty = $nameProperty;

        return $this;
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this->isLink()
            ? $this->renderLink()
            : $this->renderMeta();
    }

    /**
     * Check if meta is valid.
     */
    public function isValid(): bool
    {
        return ! empty($this->content);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Clean all the inputs.
     */
    public function clean(string $value): string
    {
        return e(strip_tags($value));
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if meta is a link tag.
     */
    protected function isLink(): bool
    {
        return in_array($this->name, [
            'alternate', 'archives', 'author', 'canonical', 'first', 'help', 'icon', 'index', 'last',
            'license', 'next', 'nofollow', 'noreferrer', 'pingback', 'prefetch', 'prev', 'publisher'
        ]);
    }

    /**
     * Get the meta name.
     */
    private function getName(bool $prefixed = true): string
    {
        return $this->clean(
            $prefixed ? $this->prefix . $this->name : $this->name
        );
    }

    /**
     * Set the meta name.
     *
     * @return $this
     */
    private function setName(string $name): static
    {
        $name       = trim(strip_tags($name));
        $this->name = str_replace([' '], '-', $name);

        return $this;
    }

    /**
     * Get the meta content.
     */
    private function getContent(): array|string
    {
        return is_array($this->content)
            ? array_map(fn($content) => $this->clean($content), $this->content)
            : $this->clean($this->content);
    }

    /**
     * Set the meta content.
     *
     * @return $this
     */
    private function setContent(array|string $content): static
    {
        if (is_array($content)) {
            $this->content = $content;
        } elseif (is_string($content)) {
            $this->content = trim($content);
        }

        return $this;
    }

    /**
     * Render the link tag.
     */
    private function renderLink(): string
    {
        return HtmlElement::withTag('link')->attributes([
            'rel'  => $this->getName(false),
            'href' => $this->getContent(),
        ])->toHtml();
    }

    /**
     * Render the meta tag.
     */
    private function renderMeta(): string
    {
        $content = Arr::wrap($this->getContent());

        return implode(PHP_EOL, array_map(fn($content) => HtmlMeta::make()->attributes([
            $this->nameProperty => $this->getName(),
            'content' => $content,
        ])->toHtml(), $content));
    }

    /**
     * Check the name property.
     *
     * @throws InvalidArgumentException
     */
    private function checkNameProperty(string &$nameProperty): void
    {
        $name    = Str::slug($nameProperty);
        $allowed = ['charset', 'http-equiv', 'itemprop', 'name', 'property'];

        if ( ! in_array($name, $allowed)) {
            throw new InvalidArgumentException(
                "The meta name property [{$name}] is not supported, " .
                "the allowed name properties are ['" . implode("', '", $allowed) . "']."
            );
        }

        $nameProperty = $name;
    }
}

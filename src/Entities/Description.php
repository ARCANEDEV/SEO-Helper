<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\Html\Elements\Meta;
use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Traits\Configurable;
use Illuminate\Support\Str;

/**
 * Class     Description
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Description implements DescriptionContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Configurable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The meta name.
     */
    protected string $name = 'description';

    /**
     * The meta content.
     */
    protected string $content = '';

    /**
     * The description max length.
     */
    protected int $max = 155;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Description instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->set($this->getConfig('default', ''));
        $this->setMax($this->getConfig('max', 155));
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
     * Make a description instance.
     *
     * @return $this
     */
    public static function make(string $content, int $max = 155): static
    {
        return new static(['default' => $content, 'max' => $max]);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the raw description content.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Get the description content.
     */
    public function get(): string
    {
        return Str::limit($this->getContent(), $this->getMax());
    }

    /**
     * Set the description content.
     *
     * @return $this
     */
    public function set(string $content): static
    {
        $this->content = trim(strip_tags($content));

        return $this;
    }

    /**
     * Get the description max length.
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set the description max length.
     *
     * @return $this
     */
    public function setMax(int $max): static
    {
        $this->checkMax($max);

        $this->max = $max;

        return $this;
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        if ( ! $this->hasContent()) {
            return '';
        }

        return Meta::make()
            ->attributes(['name' => $this->name, 'content' => $this->get()])
            ->toHtml();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if description has content.
     */
    private function hasContent(): bool
    {
        return ! empty($this->get());
    }

    /**
     * Check title max length.
     *
     * @throws InvalidArgumentException
     */
    private function checkMax(int $max): void
    {
        if ($max <= 0) {
            throw new InvalidArgumentException(
                'The description maximum length must be greater 0.'
            );
        }
    }
}

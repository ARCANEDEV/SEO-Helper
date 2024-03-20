<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\Html\Elements\Meta;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Keywords
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Keywords implements KeywordsContract
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
    protected string $name = 'keywords';

    /**
     * The meta content.
     */
    protected array $content = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Keywords instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->set($this->getConfig('default', []));
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
     * Make Keywords instance.
     *
     * @return $this
     */
    public static function make(array|string $keywords): static
    {
        return new static(['default' => $keywords]);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the raw keywords content.
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * Get the keywords content.
     */
    public function get(): string
    {
        return implode(', ', $this->getContent());
    }

    /**
     * Set the keywords content.
     *
     * @return $this
     */
    public function set(array|string $content): static
    {
        if (is_string($content)) {
            $content = explode(',', $content);
        }

        $this->content = array_map(fn($keyword) => $this->clean($keyword), (array) $content);

        return $this;
    }

    /**
     * Add a keyword to the content.
     *
     * @return $this
     */
    public function add(string $keyword): static
    {
        $this->content[] = $this->clean($keyword);

        return $this;
    }

    /**
     * Add many keywords to the content.
     *
     * @return $this
     */
    public function addMany(array $keywords): static
    {
        foreach ($keywords as $keyword) {
            $this->add($keyword);
        }

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
            ->toHtml()
        ;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if keywords has content.
     */
    private function hasContent(): bool
    {
        return ! empty($this->getContent());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Clean the string.
     */
    private function clean(string $value): string
    {
        return trim(strip_tags($value));
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\Html\Elements\HtmlElement;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Traits\Configurable;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Class     Title
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Title implements TitleContract
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
     * The title content.
     */
    protected string $title = '';

    /**
     * The site name.
     */
    protected string $siteName = '';

    /**
     * The site name visibility.
     */
    protected bool $siteNameVisibility = true;

    /**
     * The title separator.
     */
    protected string $separator = '-';

    /**
     * Display the title first.
     */
    protected bool $titleFirst = true;

    /**
     * The maximum title length.
     */
    protected int $max = 55;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make the Title instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);

        if ( ! empty($configs)) {
            $this->init();
        }
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
     * Make a Title instance.
     *
     * @return $this
     */
    public static function make(string $title, string $siteName = '', string $separator = '-'): static
    {
        return new static([
            'default'   => $title,
            'site-name' => $siteName,
            'separator' => $separator,
            'first'     => true
        ]);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the title only (without site name or separator).
     */
    public function getTitleOnly(): string
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @return $this
     */
    public function set(string $title): static
    {
        $this->checkTitle($title);
        $this->title = $title;

        return $this;
    }

    /**
     * Get the site name.
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * Set the site name.
     *
     * @return $this
     */
    public function setSiteName(?string $siteName): static
    {
        if ($siteName !== null) {
            $this->siteName = $siteName;
        }

        return $this;
    }

    /**
     * Hide the site name.
     *
     * @return $this
     */
    public function hideSiteName(): static
    {
        return $this->setSiteNameVisibility(false);
    }

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName(): static
    {
        return $this->setSiteNameVisibility(true);
    }

    /**
     * Set the site name visibility.
     *
     * @return $this
     */
    public function setSiteNameVisibility(bool $visible): static
    {
        $this->siteNameVisibility = $visible;

        return $this;
    }

    /**
     * Get the title separator.
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }

    /**
     * Set the title separator.
     *
     * @return $this
     */
    public function setSeparator(?string $separator): static
    {
        if ($separator !== null) {
            $this->separator = trim($separator);
        }

        return $this;
    }

    /**
     * Set the title first.
     *
     * @return $this
     */
    public function setFirst(): static
    {
        return $this->switchPosition(true);
    }

    /**
     * Set the title last.
     *
     * @return $this
     */
    public function setLast(): static
    {
        return $this->switchPosition(false);
    }

    /**
     * Check if the title is first.
     */
    public function isTitleFirst(): bool
    {
        return $this->titleFirst;
    }

    /**
     * Get the title max length.
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set the title max length.
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
        $title = $this->prepareTitleOutput(
            $this->isTitleFirst() ? $this->renderTitleFirst() : $this->renderTitleLast()
        );

        return HtmlElement::withTag('title')->html($title)->toHtml();
    }

    /**
     * Render the separator.
     */
    protected function renderSeparator(): string
    {
        return empty($separator = $this->getSeparator()) ? ' ' : " {$separator} ";
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        $this
            ->set($this->getConfig('default', ''))
            ->setSiteName($this->getConfig('site-name', ''))
            ->setSeparator($this->getConfig('separator', '-'))
            ->switchPosition($this->getConfig('first', true))
            ->setMax($this->getConfig('max', 55))
        ;
    }

    /**
     * Switch the title's position.
     *
     * @return $this
     */
    private function switchPosition(bool $first): static
    {
        $this->titleFirst = $first;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if site name exists.
     */
    private function hasSiteName(): bool
    {
        return ! empty($this->getSiteName()) && $this->siteNameVisibility;
    }

    /**
     * Check title.
     *
     * @throws InvalidArgumentException
     */
    private function checkTitle(string &$title): void
    {
        $title = trim($title);

        if (empty($title)) {
            throw new InvalidArgumentException('The title is required and must not be empty.');
        }
    }

    /**
     * Check title max length.
     *
     * @throws InvalidArgumentException
     */
    private function checkMax(int $max): void
    {
        if ($max <= 0) {
            throw new InvalidArgumentException('The title maximum length must be greater 0.');
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render title first.
     */
    private function renderTitleFirst(): string
    {
        return Str::of($this->getTitleOnly())
            ->when(
                $this->hasSiteName(),
                fn(Stringable $title): Stringable => $title->append($this->renderSeparator(), $this->getSiteName())
            )
            ->toString()
        ;
    }

    /**
     * Render title last.
     */
    private function renderTitleLast(): string
    {
        return Str::of($this->getTitleOnly())
            ->when(
                $this->hasSiteName(),
                fn(Stringable $title): Stringable => $title->prepend($this->getSiteName(), $this->renderSeparator())
            )
            ->toString()
        ;
    }

    /**
     * Prepare the title output.
     */
    private function prepareTitleOutput(string $output): string
    {
        return htmlspecialchars(
            Str::limit(strip_tags($output), $this->getMax()),
            ENT_QUOTES,
            'UTF-8',
            false
        );
    }
}

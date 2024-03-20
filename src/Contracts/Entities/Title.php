<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Title
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Title extends Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a Title instance.
     *
     * @return $this
     */
    public static function make(string $title, string $siteName = '', string $separator = '-'): static;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the title only (without site name or separator).
     */
    public function getTitleOnly(): string;

    /**
     * Set the title.
     *
     * @return $this
     */
    public function set(string $title): static;

    /**
     * Get the site name.
     *
     * @return string
     */
    public function getSiteName(): string;

    /**
     * Set the site name.
     *
     * @return $this
     */
    public function setSiteName(?string $siteName): static;

    /**
     * Hide the site name.
     *
     * @return $this
     */
    public function hideSiteName(): static;

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName(): static;

    /**
     * Set the site name visibility.
     *
     * @return $this
     */
    public function setSiteNameVisibility(bool $visible): static;

    /**
     * Get the title separator.
     */
    public function getSeparator(): string;

    /**
     * Set the title separator.
     *
     * @return $this
     */
    public function setSeparator(?string $separator): static;

    /**
     * Set the title first.
     *
     * @return $this
     */
    public function setFirst(): static;

    /**
     * Set the title last.
     *
     * @return $this
     */
    public function setLast(): static;

    /**
     * Check if the title is first.
     */
    public function isTitleFirst(): bool;

    /**
     * Get the title max length.
     */
    public function getMax(): int;

    /**
     * Set title max length.
     *
     * @return $this
     */
    public function setMax(int $max): static;
}

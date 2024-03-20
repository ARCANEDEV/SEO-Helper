<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

use Illuminate\Support\HtmlString;

/**
 * Interface  SeoHelper
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoHelper extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the SeoMeta instance.
     */
    public function meta(): SeoMeta;

    /**
     * Set the SeoMeta instance.
     *
     * @return $this
     */
    public function setSeoMeta(SeoMeta $seoMeta): static;

    /**
     * Get the SeoOpenGraph instance.
     */
    public function openGraph(): SeoOpenGraph;

    /**
     * Get the SeoOpenGraph instance (alias).
     *
     * @see  openGraph()
     */
    public function og(): SeoOpenGraph;

    /**
     * Get the SeoOpenGraph instance.
     *
     * @return $this
     */
    public function setSeoOpenGraph(SeoOpenGraph $seoOpenGraph): static;

    /**
     * Get SeoTwitter instance.
     */
    public function twitter(): SeoTwitter;

    /**
     * Set the SeoTwitter instance.
     *
     * @return $this
     */
    public function setSeoTwitter(SeoTwitter $seoTwitter): static;

    /**
     * Set the title.
     *
     * @return $this
     */
    public function setTitle(string $title, ?string $siteName = null, ?string $separator = null): static;

    /**
     * Set the site name.
     *
     * @return $this
     */
    public function setSiteName(string $siteName): static;

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
     * Set the description.
     *
     * @return $this
     */
    public function setDescription(string $description): static;

    /**
     * Set the keywords.
     *
     * @return $this
     */
    public function setKeywords(array|string $keywords): static;

    /**
     * Set the Image.
     *
     * @return $this
     */
    public function setImage(string $imageUrl): static;

    /**
     * Set the current URL.
     */
    public function setUrl(string $url): static;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render all seo tags with HtmlString object.
     */
    public function renderHtml(): HtmlString;

    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enableOpenGraph(): static;

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disableOpenGraph(): static;

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enableTwitter(): static;

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disableTwitter(): static;
}

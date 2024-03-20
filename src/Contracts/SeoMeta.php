<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;

/**
 * Interface  SeoMeta
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoMeta extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Title instance.
     *
     * @return $this
     */
    public function title(TitleContract $title): static;

    /**
     * Get the Title instance.
     */
    public function getTitleEntity(): TitleContract;

    /**
     * Set the Description instance.
     *
     * @return $this
     */
    public function description(DescriptionContract $description): static;

    /**
     * Get the Description instance.
     */
    public function getDescriptionEntity(): DescriptionContract;

    /**
     * Set the Keywords instance.
     *
     * @return $this
     */
    public function keywords(KeywordsContract $keywords): static;

    /**
     * Get the Keywords instance.
     */
    public function getKeywordsEntity(): KeywordsContract;

    /**
     * Set the MiscTags instance.
     *
     * @return $this
     */
    public function misc(MiscTagsContract $misc): static;

    /**
     * Get the MiscTags instance.
     */
    public function getMiscEntity(): MiscTagsContract;

    /**
     * Set the Webmasters instance.
     *
     * @return $this
     */
    public function webmasters(WebmastersContract $webmasters): static;

    /**
     * Get the Webmasters instance.
     */
    public function getWebmastersEntity(): WebmastersContract;

    /**
     * Set the Analytics instance.
     */
    public function analytics(AnalyticsContract $analytics): static;

    /**
     * Get the Analytics instance.
     */
    public function getAnalyticsEntity(): AnalyticsContract;

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
     * Hide site name.
     *
     * @return $this
     */
    public function hideSiteName(): static;

    /**
     * Show site name.
     *
     * @return $this
     */
    public function showSiteName(): static;

    /**
     * Set the description content.
     *
     * @return $this
     */
    public function setDescription(string $content): static;

    /**
     * Set the keywords content.
     *
     * @return $this
     */
    public function setKeywords(array|string $content): static;

    /**
     * Add a keyword.
     *
     * @return $this
     */
    public function addKeyword(string $keyword): static;

    /**
     * Add many keywords.
     *
     * @return $this
     */
    public function addKeywords(array $keywords): static;

    /**
     * Add a webmaster tool site verifier.
     *
     * @return $this
     */
    public function addWebmaster(string $webmaster, string $content): static;

    /**
     * Set the current URL.
     *
     * @return $this
     */
    public function setUrl(string $url): static;

    /**
     * Set the Google Analytics code.
     *
     * @return $this
     */
    public function setGoogleAnalytics(string $code): static;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add a meta tag.
     *
     * @return $this
     */
    public function addMeta(string $name, string $content): static;

    /**
     * Add many meta tags.
     *
     * @return $this
     */
    public function addMetas(array $metas): static;

    /**
     * Remove a meta from the meta collection by key.
     *
     * @return $this
     */
    public function removeMeta(array|string $names): static;

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return $this
     */
    public function resetMetas(): static;

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return $this
     */
    public function resetWebmasters(): static;
}

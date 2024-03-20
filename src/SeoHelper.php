<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoHelper as SeoHelperContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Illuminate\Support\HtmlString;

/**
 * Class     SeoHelper
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelper implements SeoHelperContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The SeoMeta instance.
     */
    protected SeoMetaContract $seoMeta;

    /**
     * The SeoOpenGraph instance.
     */
    protected SeoOpenGraphContract $seoOpenGraph;

    /**
     * The SeoTwitter instance.
     */
    protected SeoTwitterContract $seoTwitter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoHelper instance.
     */
    public function __construct(
        SeoMetaContract $seoMeta,
        SeoOpenGraphContract $seoOpenGraph,
        SeoTwitterContract $seoTwitter
    ) {
        $this->setSeoMeta($seoMeta);
        $this->setSeoOpenGraph($seoOpenGraph);
        $this->setSeoTwitter($seoTwitter);
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
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the SeoMeta instance.
     */
    public function meta(): SeoMetaContract
    {
        return $this->seoMeta;
    }

    /**
     * Set the SeoMeta instance.
     *
     * @return $this
     */
    public function setSeoMeta(SeoMetaContract $seoMeta): static
    {
        $this->seoMeta = $seoMeta;

        return $this;
    }

    /**
     * Get the SeoOpenGraph instance.
     */
    public function openGraph(): SeoOpenGraphContract
    {
        return $this->seoOpenGraph;
    }

    /**
     * Get the SeoOpenGraph instance (alias).
     *
     * @see openGraph()
     */
    public function og(): SeoOpenGraphContract
    {
        return $this->openGraph();
    }

    /**
     * Get the SeoOpenGraph instance.
     *
     * @return $this
     */
    public function setSeoOpenGraph(SeoOpenGraphContract $seoOpenGraph): static
    {
        $this->seoOpenGraph = $seoOpenGraph;

        return $this;
    }

    /**
     * Get the SeoTwitter instance.
     */
    public function twitter(): SeoTwitterContract
    {
        return $this->seoTwitter;
    }

    /**
     * Set the SeoTwitter instance.
     *
     * @return $this
     */
    public function setSeoTwitter(SeoTwitterContract $seoTwitter): static
    {
        $this->seoTwitter = $seoTwitter;

        return $this;
    }

    /**
     * Set the title.
     *
     * @return $this
     */
    public function setTitle(string $title, ?string $siteName = null, ?string $separator = null): static
    {
        $this->meta()->setTitle($title, $siteName, $separator);
        $this->openGraph()->setTitle($title);
        $this->twitter()->setTitle($title);

        return $this->setSiteName($siteName);
    }

    /**
     * Set the site name.
     *
     * @return $this
     */
    public function setSiteName(?string $siteName): static
    {
        if ( ! empty($siteName)) {
            $this->meta()->setSiteName($siteName);
            $this->openGraph()->setSiteName($siteName);
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
        $this->meta()->hideSiteName();

        return $this;
    }

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName(): static
    {
        $this->meta()->showSiteName();

        return $this;
    }

    /**
     * Set the description.
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->meta()->setDescription($description);
        $this->openGraph()->setDescription($description);
        $this->twitter()->setDescription($description);

        return $this;
    }

    /**
     * Set the keywords.
     *
     * @return $this
     */
    public function setKeywords(array|string $keywords): static
    {
        $this->meta()->setKeywords($keywords);

        return $this;
    }

    /**
     * Set Image.
     *
     * @return $this
     */
    public function setImage(string $imageUrl): static
    {
        $this->openGraph()->setImage($imageUrl);
        $this->twitter()->addImage($imageUrl);

        return $this;
    }

    /**
     * Set the current URL.
     *
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->meta()->setUrl($url);
        $this->openGraph()->setUrl($url);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render all seo tags.
     */
    public function render(): string
    {
        return implode(PHP_EOL, array_filter([
            $this->meta()->render(),
            $this->openGraph()->render(),
            $this->twitter()->render(),
        ]));
    }

    /**
     * Render all seo tags with HtmlString object.
     */
    public function renderHtml(): HtmlString
    {
        return new HtmlString(
            $this->render()
        );
    }

    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enableOpenGraph(): static
    {
        $this->openGraph()->enable();

        return $this;
    }

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disableOpenGraph(): static
    {
        $this->openGraph()->disable();

        return $this;
    }

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enableTwitter(): static
    {
        $this->twitter()->enable();

        return $this;
    }

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disableTwitter(): static
    {
        $this->twitter()->disable();

        return $this;
    }
}

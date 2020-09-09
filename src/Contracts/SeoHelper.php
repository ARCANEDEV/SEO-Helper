<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

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
     * Get SeoMeta instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoMeta
     */
    public function meta();

    /**
     * Set SeoMeta instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoMeta  $seoMeta
     *
     * @return $this
     */
    public function setSeoMeta(SeoMeta $seoMeta);

    /**
     * Get SeoOpenGraph instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function openGraph();

    /**
     * Get SeoOpenGraph instance (alias).
     *
     * @see  openGraph()
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function og();

    /**
     * Get SeoOpenGraph instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoOpenGraph  $seoOpenGraph
     *
     * @return $this
     */
    public function setSeoOpenGraph(SeoOpenGraph $seoOpenGraph);

    /**
     * Get SeoTwitter instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoTwitter
     */
    public function twitter();

    /**
     * Set SeoTwitter instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoTwitter  $seoTwitter
     *
     * @return $this
     */
    public function setSeoTwitter(SeoTwitter $seoTwitter);

    /**
     * Set title.
     *
     * @param  string       $title
     * @param  string|null  $siteName
     * @param  string|null  $separator
     *
     * @return $this
     */
    public function setTitle($title, $siteName = null, $separator = null);

    /**
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return $this
     */
    public function setSiteName($siteName);

    /**
     * Hide the site name.
     *
     * @return $this
     */
    public function hideSiteName();

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName();

    /**
     * Set description.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * Set keywords.
     *
     * @param  array|string  $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords);

    /**
     * Set Image.
     *
     * @param  string  $imageUrl
     *
     * @return \Arcanedev\SeoHelper\SeoHelper
     */
    public function setImage($imageUrl);

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return \Arcanedev\SeoHelper\SeoHelper
     */
    public function setUrl($url);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Render all seo tags with HtmlString object.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function renderHtml();

    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enableOpenGraph();

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disableOpenGraph();

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enableTwitter();

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disableTwitter();
}

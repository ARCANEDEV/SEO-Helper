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
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Title  $title
     *
     * @return $this
     */
    public function title(TitleContract $title);

    /**
     * Get the Title instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Title
     */
    public function getTitleEntity();

    /**
     * Set the Description instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Description  $description
     *
     * @return $this
     */
    public function description(DescriptionContract $description);

    /**
     * Get the Description instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Description
     */
    public function getDescriptionEntity();

    /**
     * Set the Keywords instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Keywords  $keywords
     *
     * @return $this
     */
    public function keywords(KeywordsContract $keywords);

    /**
     * Get the Keywords instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Keywords
     */
    public function getKeywordsEntity();

    /**
     * Set the MiscTags instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\MiscTags  $misc
     *
     * @return $this
     */
    public function misc(MiscTagsContract $misc);

    /**
     * Get the MiscTags instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\MiscTags
     */
    public function getMiscEntity();

    /**
     * Set the Webmasters instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Webmasters  $webmasters
     *
     * @return $this
     */
    public function webmasters(WebmastersContract $webmasters);

    /**
     * Get the Webmasters instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Webmasters
     */
    public function getWebmastersEntity();

    /**
     * Set the Analytics instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Analytics  $analytics
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function analytics(AnalyticsContract $analytics);

    /**
     * Get the Analytics instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Analytics
     */
    public function getAnalyticsEntity();

    /**
     * Set the title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
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
     * Hide site name.
     *
     * @return $this
     */
    public function hideSiteName();

    /**
     * Show site name.
     *
     * @return $this
     */
    public function showSiteName();

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return $this
     */
    public function setDescription($content);

    /**
     * Set the keywords content.
     *
     * @param  array|string  $content
     *
     * @return $this
     */
    public function setKeywords($content);

    /**
     * Add a keyword.
     *
     * @param  string  $keyword
     *
     * @return $this
     */
    public function addKeyword($keyword);

    /**
     * Add many keywords.
     *
     * @param  array  $keywords
     *
     * @return $this
     */
    public function addKeywords(array $keywords);

    /**
     * Add a webmaster tool site verifier.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return $this
     */
    public function addWebmaster($webmaster, $content);

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url);

    /**
     * Set the Google Analytics code.
     *
     * @param  string  $code
     *
     * @return $this
     */
    public function setGoogleAnalytics($code);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Add a meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function addMeta($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMetas(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  string|array  $names
     *
     * @return $this
     */
    public function removeMeta($names);

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return $this
     */
    public function resetMetas();

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return $this
     */
    public function resetWebmasters();
}

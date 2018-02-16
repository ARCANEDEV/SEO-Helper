<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;

/**
 * Interface  SeoMeta
 *
 * @package   Arcanedev\SeoHelper\Contracts
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null);

    /**
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName);

    /**
     * Hide site name.
     *
     * @return self
     */
    public function hideSiteName();

    /**
     * Show site name.
     *
     * @return self
     */
    public function showSiteName();

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function setDescription($content);

    /**
     * Set the keywords content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function setKeywords($content);

    /**
     * Add a keyword.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function addKeyword($keyword);

    /**
     * Add many keywords.
     *
     * @param  array  $keywords
     *
     * @return self
     */
    public function addKeywords(array $keywords);

    /**
     * Add a webmaster tool site verifier.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return self
     */
    public function addWebmaster($webmaster, $content);

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Set the Google Analytics code.
     *
     * @param  string  $code
     *
     * @return self
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
     * @return self
     */
    public function addMeta($name, $content);

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMetas(array $metas);

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  string|array  $names
     *
     * @return self
     */
    public function removeMeta($names);

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return self
     */
    public function resetMetas();

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return self
     */
    public function resetWebmasters();
}

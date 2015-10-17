<?php namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  SeoMeta
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoMeta extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Title instance.
     *
     * @param  Entities\TitleInterface  $title
     *
     * @return self
     */
    public function title(Entities\TitleInterface $title);

    /**
     * Set the Description instance.
     *
     * @param  Entities\DescriptionInterface  $description
     *
     * @return self
     */
    public function description(Entities\DescriptionInterface $description);

    /**
     * Set the Keywords instance.
     *
     * @param  Entities\KeywordsInterface  $keywords
     *
     * @return self
     */
    public function keywords(Entities\KeywordsInterface $keywords);

    /**
     * Set the MiscTags instance.
     *
     * @param  Entities\MiscTagsInterface  $misc
     *
     * @return self
     */
    public function misc(Entities\MiscTagsInterface $misc);

    /**
     * Set the Webmasters instance.
     *
     * @param  Entities\WebmastersInterface  $webmasters
     *
     * @return self
     */
    public function webmasters(Entities\WebmastersInterface $webmasters);

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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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

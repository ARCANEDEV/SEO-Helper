<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     SeoMeta
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMeta implements SeoMetaContract
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
     * Current URL.
     *
     * @var string
     */
    protected $currentUrl = '';

    /**
     * The Title instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\Title
     */
    protected $title;

    /**
     * The Description instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\Description
     */
    protected $description;

    /**
     * The Keywords instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\Keywords
     */
    protected $keywords;

    /**
     * The MiscTags instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MiscTags
     */
    protected $misc;

    /**
     * The Webmasters instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\Webmasters
     */
    protected $webmasters;

    /**
     * The Analytics instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\Analytics
     */
    protected $analytics;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoMeta instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);
        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        $this->title(
            new Entities\Title($this->getConfig('title', []))
        );
        $this->description(
            new Entities\Description($this->getConfig('description', []))
        );
        $this->keywords(
            new Entities\Keywords($this->getConfig('keywords', []))
        );
        $this->misc(
            new Entities\MiscTags($this->getConfig('misc', []))
        );
        $this->webmasters(
            new Entities\Webmasters($this->getConfig('webmasters', []))
        );
        $this->analytics(
            new Entities\Analytics($this->getConfig('analytics', []))
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Title instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Title  $title
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function title(TitleContract $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the Title instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Title
     */
    public function getTitleEntity()
    {
        return $this->title;
    }

    /**
     * Set the Description instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Description  $description
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function description(DescriptionContract $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the Description instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Description
     */
    public function getDescriptionEntity()
    {
        return $this->description;
    }

    /**
     * Set the Keywords instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Keywords  $keywords
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function keywords(KeywordsContract $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get the Keywords instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Keywords
     */
    public function getKeywordsEntity()
    {
        return $this->keywords;
    }

    /**
     * Set the MiscTags instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\MiscTags  $misc
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function misc(MiscTagsContract $misc)
    {
        $this->misc = $misc;

        return $this;
    }

    /**
     * Get the MiscTags instance.
     *
     * @return  \Arcanedev\SeoHelper\Contracts\Entities\MiscTags
     */
    public function getMiscEntity()
    {
        return $this->misc;
    }

    /**
     * Set the Webmasters instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Webmasters  $webmasters
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function webmasters(WebmastersContract $webmasters)
    {
        $this->webmasters = $webmasters;

        return $this;
    }

    /**
     * Get the Webmasters instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Webmasters
     */
    public function getWebmastersEntity()
    {
        return $this->webmasters;
    }

    /**
     * Set the Analytics instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\Analytics  $analytics
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function analytics(AnalyticsContract $analytics)
    {
        $this->analytics = $analytics;

        return $this;
    }

    /**
     * Get the Analytics instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\Analytics
     */
    public function getAnalyticsEntity()
    {
        return $this->analytics;
    }

    /**
     * Set the title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function setTitle($title, $siteName = null, $separator = null)
    {
        $this->title->set($title)->setSeparator($separator);

        return $this->setSiteName($siteName);
    }

    /**
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return $this
     */
    public function setSiteName($siteName)
    {
        $this->title->setSiteName($siteName);

        return $this;
    }

    /**
     * Hide site name.
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function hideSiteName()
    {
        $this->title->hideSiteName();

        return $this;
    }

    /**
     * Show site name.
     *
     * @return $this
     */
    public function showSiteName()
    {
        $this->title->showSiteName();

        return $this;
    }

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function setDescription($content)
    {
        $this->description->set($content);

        return $this;
    }

    /**
     * Set the keywords content.
     *
     * @param  array|string  $content
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function setKeywords($content)
    {
        $this->keywords->set($content);

        return $this;
    }

    /**
     * Add a keyword.
     *
     * @param  string  $keyword
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function addKeyword($keyword)
    {
        $this->keywords->add($keyword);

        return $this;
    }

    /**
     * Add many keywords.
     *
     * @param  array  $keywords
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function addKeywords(array $keywords)
    {
        $this->keywords->addMany($keywords);

        return $this;
    }

    /**
     * Add a webmaster tool site verifier.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function addWebmaster($webmaster, $content)
    {
        $this->webmasters->add($webmaster, $content);

        return $this;
    }

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function setUrl($url)
    {
        $this->currentUrl = $url;
        $this->misc->setUrl($url);

        return $this;
    }

    /**
     * Set the Google Analytics code.
     *
     * @param  string  $code
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function setGoogleAnalytics($code)
    {
        $this->analytics->setGoogle($code);

        return $this;
    }

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
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function addMeta($name, $content)
    {
        $this->misc->add($name, $content);

        return $this;
    }

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function addMetas(array $metas)
    {
        $this->misc->addMany($metas);

        return $this;
    }

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  string|array  $names
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function removeMeta($names)
    {
        $this->misc->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function resetMetas()
    {
        $this->misc->reset();

        return $this;
    }

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return \Arcanedev\SeoHelper\SeoMeta
     */
    public function resetWebmasters()
    {
        $this->webmasters->reset();

        return $this;
    }

    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, array_filter([
            $this->title->render(),
            $this->description->render(),
            $this->keywords->render(),
            $this->misc->render(),
            $this->webmasters->render(),
            $this->analytics->render(),
        ]));
    }

    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}

<?php namespace Arcanedev\SeoHelper;

use Arcanedev\Support\Traits\Configurable;

/**
 * Class     SeoMeta
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMeta implements Contracts\SeoMeta
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Configurable;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
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
     * @var \Arcanedev\SeoHelper\Contracts\Entities\TitleInterface
     */
    protected $title;

    /**
     * The Description instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\DescriptionInterface
     */
    protected $description;

    /**
     * The Keywords instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\KeywordsInterface
     */
    protected $keywords;

    /**
     * The MiscTags instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MiscTagsInterface
     */
    protected $misc;

    /**
     * The Webmasters instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\WebmastersInterface
     */
    protected $webmasters;

    /**
     * The Analytics instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\AnalyticsInterface
     */
    protected $analytics;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
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
    private function init()
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

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Title instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\TitleInterface  $title
     *
     * @return self
     */
    public function title(Contracts\Entities\TitleInterface $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the Description instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\DescriptionInterface  $description
     *
     * @return self
     */
    public function description(Contracts\Entities\DescriptionInterface $description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the Keywords instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\KeywordsInterface  $keywords
     *
     * @return self
     */
    public function keywords(Contracts\Entities\KeywordsInterface $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Set the MiscTags instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\MiscTagsInterface  $misc
     *
     * @return self
     */
    public function misc(Contracts\Entities\MiscTagsInterface $misc)
    {
        $this->misc = $misc;

        return $this;
    }

    /**
     * Set the Webmasters instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\WebmastersInterface  $webmasters
     *
     * @return self
     */
    public function webmasters(Contracts\Entities\WebmastersInterface $webmasters)
    {
        $this->webmasters = $webmasters;

        return $this;
    }

    /**
     * Set the Analytics instance.
     *
     * @param  Contracts\Entities\AnalyticsInterface  $analytics
     *
     * @return self
     */
    private function analytics(Contracts\Entities\AnalyticsInterface $analytics)
    {
        $this->analytics = $analytics;

        return $this;
    }

    /**
     * Set the title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null)
    {
        $this->title->set($title);

        if ( ! is_null($siteName)) {
            $this->title->setSiteName($siteName);
        }

        if ( ! is_null($separator)) {
            $this->title->setSeparator($separator);
        }

        return $this;
    }

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setGoogleAnalytics($code)
    {
        $this->analytics->setGoogle($code);

        return $this;
    }

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
     * @return self
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
     * @return self
     */
    public function removeMeta($names)
    {
        $this->misc->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return self
     */
    public function resetMetas()
    {
        $this->misc->reset();

        return $this;
    }

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return self
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

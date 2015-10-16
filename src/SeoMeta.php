<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\DescriptionInterface;
use Arcanedev\SeoHelper\Contracts\Entities\KeywordsInterface;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTagsInterface;
use Arcanedev\SeoHelper\Contracts\Entities\TitleInterface;
use Arcanedev\SeoHelper\Contracts\Entities\WebmastersInterface;
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
     * @var TitleInterface
     */
    protected $title;

    /**
     * The Description instance.
     *
     * @var DescriptionInterface
     */
    protected $description;

    /**
     * The Keywords instance.
     *
     * @var KeywordsInterface
     */
    protected $keywords;

    /**
     * The MiscTags instance.
     *
     * @var MiscTagsInterface
     */
    protected $misc;

    /**
     * The Webmasters instance.
     *
     * @var WebmastersInterface
     */
    protected $webmasters;

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
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Title instance.
     *
     * @param  Contracts\Entities\TitleInterface  $title
     *
     * @return self
     */
    public function title(TitleInterface $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the Description instance.
     *
     * @param  Contracts\Entities\DescriptionInterface  $description
     *
     * @return self
     */
    public function description(DescriptionInterface $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the Keywords instance.
     *
     * @param  Contracts\Entities\KeywordsInterface  $keywords
     *
     * @return self
     */
    public function keywords(KeywordsInterface $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Set the MiscTags instance.
     *
     * @param  Contracts\Entities\MiscTagsInterface  $misc
     *
     * @return self
     */
    public function misc(MiscTagsInterface $misc)
    {
        $this->misc = $misc;

        return $this;
    }

    /**
     * Set the Webmasters instance.
     *
     * @param  Contracts\Entities\WebmastersInterface  $webmasters
     *
     * @return self
     */
    public function webmasters(WebmastersInterface $webmasters)
    {
        $this->webmasters = $webmasters;

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
        $this->keywords->setContent($content);

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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
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
        ]));
    }

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
        $this->misc->addMeta($name, $content);

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
        $this->misc->addMetas($metas);

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
        $this->misc->removeMeta($names);

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
}

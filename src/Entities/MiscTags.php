<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollectionInterface;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTagsInterface;

/**
 * Class     MiscTags
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MiscTags implements MiscTagsInterface
{
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
     * Meta collection.
     *
     * @var MetaCollectionInterface
     */
    protected $metas;

    /**
     * The misc tags config.
     *
     * @var array
     */
    protected $config     = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make MiscTags instance.
     *
     * @param  array  $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->metas  = new MetaCollection;

        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        $this->addCanonical();
        $this->addRobotsMeta();
        $this->addMetas($this->getDefault());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the current URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->currentUrl;
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
        $this->addCanonical();

        return $this;
    }

    /**
     * Get default tags.
     *
     * @return array
     */
    private function getDefault()
    {
        return array_get($this->config, 'default', []);
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
        $this->metas->add($name, $content);

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
        $this->metas->addMany($metas);

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
        $this->metas->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection.
     *
     * @return self
     */
    public function reset()
    {
        $this->metas->reset();

        return $this;
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->metas->render();
    }

    /**
     * Add the robots meta.
     *
     * @return self
     */
    private function addRobotsMeta()
    {
        if ($this->isRobotsEnabled()) {
            $this->addMeta('robots', 'noindex, nofollow');
        }

        return $this;
    }

    /**
     * Add the canonical link.
     *
     * @return self
     */
    private function addCanonical()
    {
        if ($this->isCanonicalEnabled() && $this->hasUrl()) {
            $this->addMeta('canonical', $this->currentUrl);
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if has the current URL.
     *
     * @return bool
     */
    private function hasUrl()
    {
        return ! empty($this->getUrl());
    }

    /**
     * Check if canonical is enabled.
     *
     * @return bool
     */
    private function isCanonicalEnabled()
    {
        return (bool) array_get($this->config, 'canonical', false);
    }

    /**
     * Check if blocking robots is enabled.
     *
     * @return bool
     */
    private function isRobotsEnabled()
    {
        return (bool) array_get($this->config, 'robots', false);
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     MiscTags
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MiscTags implements MiscTagsContract
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
     * Meta collection.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    protected $metas;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas   = new MetaCollection;

        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        $this->addCanonical();
        $this->addRobotsMeta();
        $this->addMany($this->getConfig('default', []));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
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
     * @return $this
     */
    public function setUrl($url)
    {
        $this->currentUrl = $url;
        $this->addCanonical();

        return $this;
    }

    /**
     * Get all the metas collection.
     *
     * @return \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    public function all()
    {
        return $this->metas;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     *
     * @param  array  $defaults
     *
     * @return $this
     */
    public static function make(array $defaults = [])
    {
        return new self(['default' => $defaults]);
    }

    /**
     * Add a meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function add($name, $content)
    {
        $this->metas->addOne($name, $content);

        return $this;
    }

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMany(array $metas)
    {
        $this->metas->addMany($metas);

        return $this;
    }

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  array|string  $names
     *
     * @return $this
     */
    public function remove($names)
    {
        $this->metas->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection.
     *
     * @return $this
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
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if has the current URL.
     *
     * @return bool
     */
    private function hasUrl(): bool
    {
        return ! empty($this->getUrl());
    }

    /**
     * Check if canonical is enabled.
     *
     * @return bool
     */
    private function isCanonicalEnabled(): bool
    {
        return (bool) $this->getConfig('canonical', false);
    }

    /**
     * Check if blocking robots is enabled.
     *
     * @return bool
     */
    private function isRobotsEnabled(): bool
    {
        return (bool) $this->getConfig('robots', false);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add the robots meta.
     *
     * @return $this
     */
    private function addRobotsMeta(): self
    {
        if ($this->isRobotsEnabled())
            $this->add('robots', 'noindex, nofollow');

        return $this;
    }

    /**
     * Add the canonical link.
     *
     * @return $this
     */
    private function addCanonical(): self
    {
        if ($this->isCanonicalEnabled() && $this->hasUrl())
            $this->add('canonical', $this->currentUrl);

        return $this;
    }
}

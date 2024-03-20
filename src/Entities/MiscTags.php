<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollection as MetaCollectionContract;
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
     */
    protected string $currentUrl = '';

    /**
     * Meta collection.
     */
    protected MetaCollectionContract $metas;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas = new MetaCollection();

        $this->init();
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
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make MiscTags instance.
     *
     * @return $this
     */
    public static function make(array $defaults = []): static
    {
        return new static(['default' => $defaults]);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the current URL.
     */
    public function getUrl(): string
    {
        return $this->currentUrl;
    }

    /**
     * Set the current URL.
     *
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->currentUrl = $url;
        $this->addCanonical();

        return $this;
    }

    /**
     * Get all the metas' collection.
     */
    public function all(): MetaCollectionContract
    {
        return $this->metas;
    }

    /**
     * Add a meta tag.
     *
     * @return $this
     */
    public function add(string $name, string $content): static
    {
        $this->metas->addOne($name, $content);

        return $this;
    }

    /**
     * Add many meta tags.
     *
     * @return $this
     */
    public function addMany(array $metas): static
    {
        $this->metas->addMany($metas);

        return $this;
    }

    /**
     * Remove a meta from the meta collection by key.
     *
     * @return $this
     */
    public function remove(array|string $names): static
    {
        $this->metas->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection.
     *
     * @return $this
     */
    public function reset(): static
    {
        $this->metas->reset();

        return $this;
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this->metas->render();
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        $this
            ->addCanonical()
            ->addRobotsMeta()
            ->addMany($this->getConfig('default', []))
        ;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if it has the current URL.
     */
    private function hasUrl(): bool
    {
        return ! empty($this->getUrl());
    }

    /**
     * Check if canonical is enabled.
     */
    private function isCanonicalEnabled(): bool
    {
        return (bool) $this->getConfig('canonical', false);
    }

    /**
     * Check if blocking robots is enabled.
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
    private function addRobotsMeta(): static
    {
        if ($this->isRobotsEnabled()) {
            $this->add('robots', 'noindex, nofollow');
        }

        return $this;
    }

    /**
     * Add the canonical link.
     *
     * @return $this
     */
    private function addCanonical(): static
    {
        if ($this->isCanonicalEnabled() && $this->hasUrl()) {
            $this->add('canonical', $this->currentUrl);
        }

        return $this;
    }
}

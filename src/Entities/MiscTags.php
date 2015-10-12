<?php namespace Arcanedev\SeoHelper\Entities;

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
     * The misc tags config.
     *
     * @var array
     */
    protected $config = [];

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

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, array_filter([
            $this->renderRobots(),
            $this->renderAuthor(),
            $this->renderPublisher(),
            $this->renderCanonical(),
        ]));
    }

    /**
     * @return string
     */
    public function renderCanonical()
    {
        if ($this->isCanonicalEnabled() && $this->hasUrl()) {
            return '<link rel="canonical" href="' . $this->getUrl() .'">'; // HTML 5
        }

        return '';
    }

    /**
     * Blocking robots to index the content.
     *
     * @return string
     */
    public function renderRobots()
    {
        if ($this->isRobotsEnabled()) {
            return '<meta name="robots" content="noindex, nofollow">';
        }

        return '';
    }

    /**
     * Render the author tag.
     *
     * @return string
     */
    public function renderAuthor()
    {
        $author = array_get($this->config, 'author', '');

        if (empty($author)) {
            return '';
        }

        return '<meta name="author" content="' . $author . '">';
    }

    /**
     * Render the publisher tag.
     *
     * @return string
     */
    public function renderPublisher()
    {
        if (empty($publisher = array_get($this->config, 'publisher', ''))) {
            return '';
        }

        return '<link rel="publisher" href="' . $publisher . '">';
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

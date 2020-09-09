<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\Html\Elements\Element;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Traits\Configurable;
use Illuminate\Support\Str;

/**
 * Class     Title
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Title implements TitleContract
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
     * The title content.
     *
     * @var string
     */
    protected $title      = '';

    /**
     * The site name.
     *
     * @var string
     */
    protected $siteName   = '';

    /**
     * The site name visibility.
     *
     * @var bool
     */
    protected $siteNameVisibility = true;

    /**
     * The title separator.
     *
     * @var string
     */
    protected $separator  = '-';

    /**
     * Display the title first.
     *
     * @var bool
     */
    protected $titleFirst = true;

    /**
     * The maximum title length.
     *
     * @var int
     */
    protected $max        = 55;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make the Title instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);

        if ( ! empty($configs))
            $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        $this->set($this->getConfig('default', ''));
        $this->setSiteName($this->getConfig('site-name', ''));
        $this->setSeparator($this->getConfig('separator', '-'));
        $this->switchPosition($this->getConfig('first', true));
        $this->setMax($this->getConfig('max', 55));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get title only (without site name or separator).
     *
     * @return string
     */
    public function getTitleOnly()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function set($title)
    {
        $this->checkTitle($title);
        $this->title = $title;

        return $this;
    }

    /**
     * Get site name.
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set site name.
     *
     * @param  string  $siteName
     *
     * @return $this
     */
    public function setSiteName($siteName)
    {
        if ( ! is_null($siteName))
            $this->siteName = $siteName;

        return $this;
    }

    /**
     * Hide the site name.
     *
     * @return $this
     */
    public function hideSiteName()
    {
        return $this->setSiteNameVisibility(false);
    }

    /**
     * Show the site name.
     *
     * @return $this
     */
    public function showSiteName()
    {
        return $this->setSiteNameVisibility(true);
    }

    /**
     * Set the site name visibility.
     *
     * @param  bool  $visible
     *
     * @return $this
     */
    public function setSiteNameVisibility($visible)
    {
        $this->siteNameVisibility = (bool) $visible;

        return $this;
    }

    /**
     * Get title separator.
     *
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Set title separator.
     *
     * @param  string  $separator
     *
     * @return $this
     */
    public function setSeparator($separator)
    {
        if ( ! is_null($separator))
            $this->separator = trim($separator);

        return $this;
    }

    /**
     * Set title first.
     *
     * @return $this
     */
    public function setFirst()
    {
        return $this->switchPosition(true);
    }

    /**
     * Set title last.
     *
     * @return $this
     */
    public function setLast()
    {
        return $this->switchPosition(false);
    }

    /**
     * Switch title position.
     *
     * @param  bool  $first
     *
     * @return $this
     */
    private function switchPosition($first)
    {
        $this->titleFirst = boolval($first);

        return $this;
    }

    /**
     * Check if title is first.
     *
     * @return bool
     */
    public function isTitleFirst()
    {
        return $this->titleFirst;
    }

    /**
     * Get title max length.
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set title max length.
     *
     * @param  int  $max
     *
     * @return $this
     */
    public function setMax($max)
    {
        $this->checkMax($max);

        $this->max = $max;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a Title instance.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return $this
     */
    public static function make($title, $siteName = '', $separator = '-')
    {
        return new self([
            'default'   => $title,
            'site-name' => $siteName,
            'separator' => $separator,
            'first'     => true
        ]);
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        $separator = $this->renderSeparator();
        $output    = $this->isTitleFirst()
            ? $this->renderTitleFirst($separator)
            : $this->renderTitleLast($separator);

        return Element::withTag('title')->html(
            $this->prepareTitleOutput($output)
        )->toHtml();
    }

    /**
     * Render the separator.
     *
     * @return string
     */
    protected function renderSeparator()
    {
        return empty($separator = $this->getSeparator()) ? ' ' : " $separator ";
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
     * Check if site name exists.
     *
     * @return bool
     */
    private function hasSiteName(): bool
    {
        return ! empty($this->getSiteName()) && $this->siteNameVisibility;
    }

    /**
     * Check title.
     *
     * @param  string  $title
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     */
    private function checkTitle(&$title): void
    {
        if ( ! is_string($title)) {
            $type = gettype($title);

            throw new InvalidArgumentException("The title must be a string value, [$type] is given.");
        }

        $title = trim($title);

        if (empty($title)) {
            throw new InvalidArgumentException('The title is required and must not be empty.');
        }
    }

    /**
     * Check title max length.
     *
     * @param  int  $max
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     */
    private function checkMax($max): void
    {
        if ( ! is_int($max)) {
            throw new InvalidArgumentException('The title maximum length must be integer.');
        }

        if ($max <= 0) {
            throw new InvalidArgumentException('The title maximum length must be greater 0.');
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render title first.
     *
     * @param  string  $separator
     *
     * @return string
     */
    private function renderTitleFirst(string $separator): string
    {
        $output   = [];
        $output[] = $this->getTitleOnly();

        if ($this->hasSiteName()) {
            $output[] = $separator;
            $output[] = $this->getSiteName();
        }

        return implode('', $output);
    }

    /**
     * Render title last.
     *
     * @param  string  $separator
     *
     * @return string
     */
    private function renderTitleLast(string $separator): string
    {
        $output = [];

        if ($this->hasSiteName()) {
            $output[] = $this->getSiteName();
            $output[] = $separator;
        }

        $output[] = $this->getTitleOnly();

        return implode('', $output);
    }

    /**
     * Prepare the title output.
     *
     * @param  string  $output
     *
     * @return string
     */
    private function prepareTitleOutput(string $output): string
    {
        return htmlspecialchars(
            Str::limit(strip_tags($output), $this->getMax()), ENT_QUOTES, 'UTF-8', false
        );
    }
}

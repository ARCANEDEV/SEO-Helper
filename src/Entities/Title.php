<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\TitleInterface;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Title
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Title implements TitleInterface
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
     * The title content.
     *
     * @var string
     */
    protected $title        = '';

    /**
     * The site name.
     *
     * @var string
     */
    protected $siteName     = '';

    /**
     * The title separator.
     *
     * @var string
     */
    protected $separator    = '-';

    /**
     * Display the title first.
     *
     * @var bool
     */
    protected $titleFirst   = true;

    /**
     * The maximum title length.
     *
     * @var int
     */
    protected $max          = 55;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the Title instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);

        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        $this->setTitle($this->getConfig('default', ''));
        $this->setSiteName($this->getConfig('site-name', ''));
        $this->setSeparator($this->getConfig('separator', '-'));
        $this->switchPosition($this->getConfig('first', true));
        $this->setMax($this->getConfig('max', 55));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title)
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
     * @return self
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

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
     * @return self
     */
    public function setSeparator($separator)
    {
        $this->separator = trim($separator);

        return $this;
    }

    /**
     * Set title first.
     *
     * @return self
     */
    public function setFirst()
    {
        return $this->switchPosition(true);
    }

    /**
     * Set title last.
     *
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setMax($max)
    {
        $this->checkMax($max);

        $this->max = $max;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a Title instance.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
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
        $separator = empty($this->getSeparator()) ? ' ' : ' ' . $this->getSeparator() . ' ';

        $output    = $this->isTitleFirst()
            ? $this->renderTitleFirst($separator)
            : $this->renderTitleLast($separator);

        $output    = e(strip_tags($output));

        return '<title>' . str_limit($output, $this->getMax()) . '</title>';
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check title.
     *
     * @param  string  $title
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     */
    private function checkTitle(&$title)
    {
        if ( ! is_string($title)) {
            $type = gettype($title);

            throw new InvalidArgumentException(
                "The title must be a string value, [$type] is given."
            );
        }

        $title = trim($title);

        if (empty($title)) {
            throw new InvalidArgumentException(
                'The title is required and must not be empty.'
            );
        }
    }

    /**
     * Check title max length.
     *
     * @param  int  $max
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     */
    private function checkMax($max)
    {
        if ( ! is_int($max)) {
            throw new InvalidArgumentException(
                'The title maximum lenght must be integer.'
            );
        }

        if ($max <= 0) {
            throw new InvalidArgumentException(
                'The title maximum lenght must be greater 0.'
            );
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render title first.
     *
     * @param  string  $separator
     *
     * @return string
     */
    private function renderTitleFirst($separator)
    {
        $output   = [];
        $output[] = $this->getTitle();

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
    private function renderTitleLast($separator)
    {
        $output = [];

        if ($this->hasSiteName()) {
            $output[] = $this->getSiteName();
            $output[] = $separator;
        }

        $output[] = $this->getTitle();

        return implode('', $output);
    }

    /**
     * Check if site name exists.
     *
     * @return bool
     */
    private function hasSiteName()
    {
        return ! empty($this->getSiteName());
    }
}

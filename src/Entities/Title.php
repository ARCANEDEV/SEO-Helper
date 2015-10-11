<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\TitleInterface;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;

/**
 * Class     Title
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Title implements TitleInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Title.
     *
     * @var string
     */
    protected $title        = '';

    /**
     * Site name.
     *
     * @var string
     */
    protected $siteName     = '';

    /**
     * Title separator.
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
     * Maximum title length.
     *
     * @var int
     */
    protected $max          = 55;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Title instance.
     *
     * @param  array  $config
     */
    public function __construct(array $config = [])
    {
        $this->setTitle(array_get($config, 'default', ''));
        $this->setSiteName(array_get($config, 'site-name', ''));
        $this->setSeparator(array_get($config, 'separator', '-'));
        $this->switchPosition(array_get($config, 'first', true));
        $this->setMax(array_get($config, 'max', 55));
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
        $separator = ' ';
        $separator = empty($this->getSeparator()) ? $separator : ' ' . $this->getSeparator() . ' ';

        $output    = $this->isTitleFirst()
            ? $this->renderTitleFirst($separator)
            : $this->renderTitleLast($separator);

        return '<title>' . str_limit(implode('', $output), $this->getMax()) . '</title>';
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
                "The title is required and must not be empty."
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
     * @return array
     */
    private function renderTitleFirst($separator)
    {
        $output   = [];
        $output[] = $this->getTitle();

        if ($this->hasSiteName()) {
            $output[] = $separator;
            $output[] = $this->getSiteName();
        }

        return $output;
    }

    /**
     * Render title last.
     *
     * @param  string  $separator
     *
     * @return array
     */
    private function renderTitleLast($separator)
    {
        $output = [];

        if ($this->hasSiteName()) {
            $output[] = $this->getSiteName();
            $output[] = $separator;
        }

        $output[] = $this->getTitle();

        return $output;
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

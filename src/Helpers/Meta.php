<?php namespace Arcanedev\SeoHelper\Helpers;

use Arcanedev\SeoHelper\Contracts\Helpers\Meta as MetaContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;

/**
 * Class     Meta
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Meta implements MetaContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Meta prefix name.
     *
     * @var string
     */
    protected $prefix  = '';

    /**
     * The meta name property.
     *
     * @var string
     */
    protected $nameProperty = 'name';

    /**
     * Meta name.
     *
     * @var string
     */
    protected $name    = '';

    /**
     * Meta content.
     *
     * @var string
     */
    protected $content = '';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Meta instance.
     *
     * @param  string  $name
     * @param  string  $content
     * @param  string  $prefix
     * @param  string  $propertyName
     */
    public function __construct($name, $content, $propertyName = 'name', $prefix = '')
    {
        $this->setPrefix($prefix);
        $this->setName($name);
        $this->setContent($content);
        $this->setNameProperty($propertyName);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the meta name.
     *
     * @return string
     */
    public function key()
    {
        return $this->name;
    }

    /**
     * Set the meta prefix name.
     *
     * @param  string  $prefix
     *
     * @return \Arcanedev\SeoHelper\Helpers\Meta
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Set the meta property name.
     *
     * @param  string  $nameProperty
     *
     * @return \Arcanedev\SeoHelper\Helpers\Meta
     */
    public function setNameProperty($nameProperty)
    {
        $this->checkNameProperty($nameProperty);
        $this->nameProperty = $nameProperty;

        return $this;
    }

    /**
     * Get the meta name.
     *
     * @param  bool  $prefixed
     *
     * @return string
     */
    private function getName($prefixed = true)
    {
        $name = $this->name;

        if ($prefixed) {
            $name = $this->prefix . $name;
        }

        return $this->clean($name);
    }

    /**
     * Set the meta name.
     *
     * @param  string  $name
     *
     * @return \Arcanedev\SeoHelper\Helpers\Meta
     */
    private function setName($name)
    {
        $name       = trim(strip_tags($name));
        $this->name = str_replace([' '], '-', $name);

        return $this;
    }

    /**
     * Get the meta content.
     *
     * @return string
     */
    private function getContent()
    {
        return $this->clean($this->content);
    }

    /**
     * Set the meta content.
     *
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\Helpers\Meta
     */
    private function setContent($content)
    {
        if (is_string($content)) {
            $this->content = trim($content);
        }

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Meta instance.
     *
     * @param  string  $name
     * @param  string  $content
     * @param  string  $propertyName
     * @param  string  $prefix
     *
     * @return \Arcanedev\SeoHelper\Helpers\Meta
     */
    public static function make($name, $content, $propertyName = 'name', $prefix = '')
    {
        return new self($name, $content, $propertyName, $prefix);
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        if ($this->isLink()) {
            return $this->renderLink();
        }

        return $this->renderMeta();
    }

    /**
     * Render the link tag.
     *
     * @return string
     */
    private function renderLink()
    {
        return '<link rel="' . $this->getName(false) . '" href="' . $this->getContent() . '">';
    }

    /**
     * Render the meta tag.
     *
     * @return string
     */
    private function renderMeta()
    {
        $output   = [];
        $output[] = $this->nameProperty . '="' . $this->getName() . '"';
        $output[] = 'content="' . $this->getContent() . '"';

        return '<meta ' . implode(' ', $output) . '>';
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

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if meta is a link tag.
     *
     * @return bool
     */
    protected function isLink()
    {
        return in_array($this->name, [
            'alternate', 'archives', 'author', 'canonical', 'first', 'help', 'icon', 'index', 'last',
            'license', 'next', 'nofollow', 'noreferrer', 'pingback', 'prefetch', 'prev', 'publisher'
        ]);
    }

    /**
     * Check if meta is valid.
     *
     * @return bool
     */
    public function isValid()
    {
        return ! empty($this->content);
    }

    /**
     * Check the name property.
     *
     * @param  string  $nameProperty
     *
     * @throws InvalidArgumentException
     */
    private function checkNameProperty(&$nameProperty)
    {
        if ( ! is_string($nameProperty)) {
            throw new InvalidArgumentException(
                'The meta name property is must be a string value, ' . gettype($nameProperty) . ' is given.'
            );
        }

        $name    = str_slug($nameProperty);
        $allowed = ['charset', 'http-equiv', 'itemprop', 'name', 'property'];

        if ( ! in_array($name, $allowed)) {
            throw new InvalidArgumentException(
                "The meta name property [$name] is not supported, ".
                "the allowed name properties are ['". implode("', '", $allowed) . "']."
            );
        }

        $nameProperty = $name;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Clean all the inputs.
     *
     * @param  string  $value
     *
     * @return string
     */
    public function clean($value)
    {
        return htmlentities(strip_tags($value));
    }
}

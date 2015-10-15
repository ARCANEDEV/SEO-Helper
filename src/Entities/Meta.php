<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaInterface;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;

/**
 * Class     Meta
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Meta implements MetaInterface
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

    /**
     * List of links tags instead of metas tags.
     *
     * @var array
     */
    protected $links = [
        'alternate', 'archives', 'author', 'canonical', 'first', 'help', 'icon', 'index', 'last',
        'license', 'next', 'nofollow', 'noreferrer', 'pingback', 'prefetch', 'prev', 'publisher'
    ];

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
    public function __construct($name, $content, $prefix = '', $propertyName = 'name')
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
     * @return self
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
     * @return self
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
     * @return self
     */
    private function setName($name)
    {
        $this->name = str_slug(strip_tags($name));

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
     * @return self
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
     * @param  string  $prefix
     * @param  string  $propertyName
     *
     * @return self
     */
    public static function make($name, $content, $prefix = '', $propertyName = 'name')
    {
        return new self($name, $content, $prefix, $propertyName);
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
        return in_array($this->name, $this->links);
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
        $allowed = ['name', 'property'];

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

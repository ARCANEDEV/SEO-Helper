<?php namespace Arcanedev\SeoHelper\Helpers;

use Arcanedev\Html\Elements\Element;
use Arcanedev\Html\Elements\Meta as HtmlMeta;
use Arcanedev\SeoHelper\Contracts\Helpers\Meta as MetaContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Illuminate\Support\{Arr, Str};

/**
 * Class     Meta
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Meta implements MetaContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Meta prefix name.
     *
     * @var string
     */
    protected $prefix = '';

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
    protected $name = '';

    /**
     * Meta content.
     *
     * @var string|array
     */
    protected $content;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     *
     * @param  string        $name
     * @param  string|array  $content
     * @param  string        $prefix
     * @param  string        $propertyName
     */
    public function __construct($name, $content, $propertyName = 'name', $prefix = '')
    {
        $this->setPrefix($prefix);
        $this->setName($name);
        $this->setContent($content);
        $this->setNameProperty($propertyName);
    }

    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
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
     * @return $this
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
     * @return $this
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
        return $this->clean(
            $prefixed ? $this->prefix.$this->name : $this->name
        );
    }

    /**
     * Set the meta name.
     *
     * @param  string  $name
     *
     * @return $this
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
     * @return string|array
     */
    private function getContent()
    {
        return is_array($this->content)
            ? array_map(function ($content) { return $this->clean($content); }, $this->content)
            : $this->clean($this->content);
    }

    /**
     * Set the meta content.
     *
     * @param  string|array  $content
     *
     * @return $this
     */
    private function setContent($content)
    {
        if (is_array($content))
            $this->content = $content;
        elseif (is_string($content))
            $this->content = trim($content);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Meta instance.
     *
     * @param  string        $name
     * @param  string|array  $content
     * @param  string        $propertyName
     * @param  string        $prefix
     *
     * @return $this
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
        return $this->isLink()
            ? $this->renderLink()
            : $this->renderMeta();
    }

    /**
     * Render the link tag.
     *
     * @return string
     */
    private function renderLink(): string
    {
        return Element::withTag('link')->attributes([
            'rel'  => $this->getName(false),
            'href' => $this->getContent(),
        ])->toHtml();
    }

    /**
     * Render the meta tag.
     *
     * @return string
     */
    private function renderMeta(): string
    {
        $content = Arr::wrap($this->getContent());

        return implode(PHP_EOL, array_map(function ($content) {
            return HtmlMeta::make()->attributes([
                $this->nameProperty => $this->getName(),
                'content' => $content,
            ])->toHtml();
        }, $content));
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
    private function checkNameProperty(&$nameProperty): void
    {
        if ( ! is_string($nameProperty)) {
            throw new InvalidArgumentException(
                'The meta name property is must be a string value, '.gettype($nameProperty).' is given.'
            );
        }

        $name    = Str::slug($nameProperty);
        $allowed = ['charset', 'http-equiv', 'itemprop', 'name', 'property'];

        if ( ! in_array($name, $allowed)) {
            throw new InvalidArgumentException(
                "The meta name property [$name] is not supported, ".
                "the allowed name properties are ['".implode("', '", $allowed)."']."
            );
        }

        $nameProperty = $name;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
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
        return e(strip_tags($value));
    }
}

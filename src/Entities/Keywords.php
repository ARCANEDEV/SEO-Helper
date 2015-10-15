<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\KeywordsInterface;
use Arcanedev\SeoHelper\Helpers\Meta;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Keywords
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Keywords implements KeywordsInterface
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
     * The meta name.
     *
     * @var string
     */
    protected $name    = 'keywords';

    /**
     * The meta content.
     *
     * @var array
     */
    protected $content = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Keywords instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->setContent($this->getConfig('default', []));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set description content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function setContent($content)
    {
        if (is_string($content)) {
            $content = explode(',', $content);
        }

        if ( ! is_array($content)) {
            $content = (array) $content;
        }

        $this->content = array_map('trim', $content);

        return $this;
    }

    /**
     * Add a keyword to the content.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function add($keyword)
    {
        $this->content[] = $keyword;

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
        if ( ! $this->hasContent()) {
            return '';
        }

        return Meta::make($this->name, implode(', ', $this->getContent()))->render();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if keywords has content.
     *
     * @return bool
     */
    private function hasContent()
    {
        return ! empty($this->getContent());
    }
}

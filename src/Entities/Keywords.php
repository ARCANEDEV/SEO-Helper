<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\KeywordsInterface;

/**
 * Class     Keywords
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Keywords implements KeywordsInterface
{
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
     * @param  array  $config
     */
    public function __construct(array $config = [])
    {
        $this->setContent(array_get($config, 'default', []));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set description content.
     *
     * @param  string  $content
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

        return '<meta name="' . $this->name . '" content="' . implode(', ', $this->getContent()) . '">';
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

<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Helpers\Meta;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Keywords
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Keywords implements KeywordsContract
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

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * Make Keywords instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->set($this->getConfig('default', []));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Get raw keywords content.
     *
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get keywords content.
     *
     * @return string
     */
    public function get()
    {
        return implode(', ', $this->getContent());
    }

    /**
     * Set keywords content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function set($content)
    {
        if (is_string($content)) {
            $content = explode(',', $content);
        }

        if ( ! is_array($content)) {
            $content = (array) $content;
        }

        $this->content = array_map(function ($keyword) {
            return $this->clean($keyword);
        }, $content);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Make Keywords instance.
     *
     * @param  array|string  $keywords
     *
     * @return self
     */
    public static function make($keywords)
    {
        return new self(['default' => $keywords]);
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
        $this->content[] = $this->clean($keyword);

        return $this;
    }

    /**
     * Add many keywords to the content.
     *
     * @param  array  $keywords
     *
     * @return self
     */
    public function addMany(array $keywords)
    {
        foreach ($keywords as $keyword) {
            $this->add($keyword);
        }

        return $this;
    }

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

        return Meta::make($this->name, $this->get())->render();
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
     * Check if keywords has content.
     *
     * @return bool
     */
    private function hasContent()
    {
        return ! empty($this->getContent());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Clean the string.
     *
     * @param  string  $value
     *
     * @return string
     */
    private function clean($value)
    {
        return trim(strip_tags($value));
    }
}

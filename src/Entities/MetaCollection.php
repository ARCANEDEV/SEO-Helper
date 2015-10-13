<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\Support\Collection;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollection extends Collection implements Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The items contained in the collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Ignored tags, they have dedicated class.
     *
     * @var array
     */
    protected $ignored = [
        'description', 'keywords'
    ];

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
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Add a meta to collection.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function add($name, $content)
    {
        $name = strtolower($name);

        if (empty($content) || $this->isIgnored($name)) {
            return $this;
        }

        $this->put($name, $content);

        return $this;
    }

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return self
     */
    public function addMany(array $metas)
    {
        foreach ($metas as $name => $content) {
            $this->add($name, $content);
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
        $output = [];

        foreach ($this->items as $name => $content) {
            $output[] = $this->isLink($name)
                ? $this->renderLink($name, $content)
                : $this->renderMeta($name, $content);
        }

        return implode(PHP_EOL, $output);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Render Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the meta tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return string
     */
    protected function renderMeta($name, $content)
    {
        return '<meta name="' . $name . '" content="' . $content . '">';
    }

    /**
     * Render the link tag.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return string
     */
    protected function renderLink($name, $content)
    {
        return '<link rel="' . $name . '" href="' . $content . '">';
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if meta is ignored.
     *
     * @param  string  $name
     *
     * @return bool
     */
    protected function isIgnored($name)
    {
        return in_array($name, $this->ignored);
    }

    /**
     * Check if meta is a link tag.
     *
     * @param  string  $name
     *
     * @return bool
     */
    protected function isLink($name)
    {
        return in_array($name, $this->links);
    }
}

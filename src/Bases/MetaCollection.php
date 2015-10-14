<?php namespace Arcanedev\SeoHelper\Bases;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollectionInterface;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Entities\Meta;
use Arcanedev\Support\Collection;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class MetaCollection extends Collection implements MetaCollectionInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Meta tag prefix.
     *
     * @var string
     */
    protected $prefix = '';

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
    protected $ignored = [];

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set meta prefix name.
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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
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
     * Add a meta to collection.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function add($name, $content)
    {
        if ( ! empty($name) && ! empty($content)) {
            $this->addMeta($name, $content);
        }

        return $this;
    }

    /**
     * Make a meta and add it to collection.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    protected function addMeta($name, $content)
    {
        $meta = Meta::make($name, $content, $this->prefix);

        $this->put($meta->key(), $meta);

        return $this;
    }

    /**
     * Remove a meta from the meta collection by key.
     *
     * @param  array|string  $names
     *
     * @return self
     */
    public function remove($names)
    {
        $names = $this->prepareName($names);

        $this->forget($names);

        return $this;
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        $output = $this->map(function (Renderable $meta) {
            return $meta->render();
        })->toArray();

        return implode(PHP_EOL, array_filter($output));
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Prepare names.
     *
     * @param  array|string  $names
     *
     * @return array
     */
    protected function prepareName($names)
    {
        $prepared = array_map(function ($name) {
            return strtolower(trim($name));
        }, (array) $names);

        return $prepared;
    }
}

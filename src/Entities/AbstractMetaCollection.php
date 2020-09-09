<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollection as MetaCollectionContract;
use Arcanedev\SeoHelper\Contracts\Helpers\Meta as MetaContract;
use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Helpers\Meta;
use Illuminate\Support\Collection;

/**
 * Class     AbstractMetaCollection
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractMetaCollection extends Collection implements MetaCollectionContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Meta tag prefix.
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Meta tag name property.
     *
     * @var string
     */
    protected $nameProperty = 'name';

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

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set meta prefix name.
     *
     * @param  string  $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this->refresh();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add many meta tags.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMany(array $metas)
    {
        foreach ($metas as $name => $content) {
            $this->addOne($name, $content);
        }

        return $this;
    }

    /**
     * Add a meta to collection.
     *
     * @param  string        $name
     * @param  string|array  $content
     *
     * @return $this
     */
    public function addOne($name, $content)
    {
        if (empty($name) || empty($content))
            return $this;

        return $this->addMeta($name, $content);
    }

    /**
     * Make a meta and add it to collection.
     *
     * @param  string        $name
     * @param  string|array  $content
     *
     * @return $this
     */
    protected function addMeta($name, $content)
    {
        $meta = Meta::make($name, $content, $this->nameProperty, $this->prefix);

        return $this->put($meta->key(), $meta);
    }

    /**
     * Remove a meta from the collection by key.
     *
     * @param  array|string  $names
     *
     * @return $this
     */
    public function remove($names)
    {
        $names = static::prepareName($names);

        return $this->forget($names);
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->map(function (Renderable $meta) {
                return $meta->render();
            })
            ->filter()
            ->implode(PHP_EOL);
    }

    /**
     * Reset the collection.
     *
     * @return $this
     */
    public function reset()
    {
        $this->items = [];

        return $this;
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
     |  Check Functions
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Other Functions
     | -----------------------------------------------------------------
     */

    /**
     * Refresh meta collection items.
     *
     * @return $this
     */
    private function refresh()
    {
        return $this->map(function (MetaContract $meta) {
            return $meta->setPrefix($this->prefix);
        });
    }

    /**
     * Prepare names.
     *
     * @param  array|string  $names
     *
     * @return array
     */
    protected static function prepareName($names)
    {
        return array_map(function ($name) {
            return strtolower(trim($name));
        }, (array) $names);
    }
}

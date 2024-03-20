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
     */
    protected string $prefix = '';

    /**
     * Meta tag name property.
     */
    protected string $nameProperty = 'name';

    /**
     * Ignored tags, they have dedicated class.
     */
    protected array $ignored = [];

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
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set meta prefix name.
     *
     * @return $this
     */
    public function setPrefix(string $prefix): static
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
     * @return $this
     */
    public function addMany(array $metas): static
    {
        foreach ($metas as $name => $content) {
            $this->addOne($name, $content);
        }

        return $this;
    }

    /**
     * Add a meta to collection.
     *
     * @return $this
     */
    public function addOne(string $name, array|string $content): static
    {
        if (empty($name) || empty($content)) {
            return $this;
        }

        return $this->addMeta($name, $content);
    }

    /**
     * Remove a meta from the collection by key.
     *
     * @return $this
     */
    public function remove(array|string $names): static
    {
        $names = static::prepareName((array) $names);

        return $this->forget($names);
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this
            ->map(fn(Renderable $meta) => $meta->render())
            ->filter()
            ->implode(PHP_EOL)
        ;
    }

    /**
     * Reset the collection.
     *
     * @return $this
     */
    public function reset(): static
    {
        $this->items = [];

        return $this;
    }

    /**
     * Prepare names.
     */
    protected static function prepareName(array $names): array
    {
        return array_map(fn($name) => mb_strtolower(trim($name)), $names);
    }

    /**
     * Make a meta and add it to collection.
     *
     * @return $this
     */
    protected function addMeta(string $name, array|string $content): static
    {
        $meta = Meta::make($name, $content, $this->nameProperty, $this->prefix);

        return $this->put($meta->key(), $meta);
    }

    /* -----------------------------------------------------------------
     |  Check Functions
     | -----------------------------------------------------------------
     */

    /**
     * Check if meta is ignored.
     */
    protected function isIgnored(string $name): bool
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
    private function refresh(): static
    {
        return $this->map(fn(MetaContract $meta) => $meta->setPrefix($this->prefix));
    }
}

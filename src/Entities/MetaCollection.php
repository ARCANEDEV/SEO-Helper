<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Helpers\Meta;

/**
 * Class     MetaCollection
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollection extends AbstractMetaCollection
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Ignored tags, they have dedicated class.
     */
    protected array $ignored = [
        'description',
        'keywords'
    ];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add a meta to collection.
     *
     * @return $this
     */
    public function addOne(string $name, array|string $content): static
    {
        $meta = Meta::make($name, $content);

        if ($meta->isValid() && ! $this->isIgnored($name)) {
            $this->put($meta->key(), $meta);
        }

        return $this;
    }
}

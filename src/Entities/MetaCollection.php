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
     *
     * @var array
     */
    protected $ignored = [
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
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function addOne($name, $content)
    {
        $meta = Meta::make($name, $content);

        if ($meta->isValid() && ! $this->isIgnored($name)) {
            $this->put($meta->key(), $meta);
        }

        return $this;
    }
}

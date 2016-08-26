<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Bases\MetaCollection as BaseMetaCollection;
use Arcanedev\SeoHelper\Helpers\Meta;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollection extends BaseMetaCollection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Ignored tags, they have dedicated class.
     *
     * @var array
     */
    protected $ignored = [
        'description', 'keywords'
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
     * @return \Arcanedev\SeoHelper\Entities\MetaCollection
     */
    public function add($name, $content)
    {
        $meta = Meta::make($name, $content);

        if ($meta->isValid() && ! $this->isIgnored($name)) {
            $this->put($meta->key(), $meta);
        }

        return $this;
    }
}

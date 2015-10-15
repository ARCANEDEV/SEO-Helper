<?php namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Bases\MetaCollection as BaseMetaCollection;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Entities\OpenGraph
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollection extends BaseMetaCollection
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
    protected $prefix       = 'og:';

    /**
     * Meta tag name property.
     *
     * @var string
     */
    protected $nameProperty = 'property';
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Entities\AbstractMetaCollection;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Entities\OpenGraph
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaCollection extends AbstractMetaCollection
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
    protected $prefix       = 'og:';

    /**
     * Meta tag name property.
     *
     * @var string
     */
    protected $nameProperty = 'property';
}

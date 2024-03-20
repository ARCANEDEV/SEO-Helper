<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities\OpenGraph;

use Arcanedev\SeoHelper\Entities\AbstractMetaCollection;

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
     * Meta tag prefix.
     */
    protected string $prefix       = 'og:';

    /**
     * Meta tag name property.
     *
     * @var string
     */
    protected string $nameProperty = 'property';
}

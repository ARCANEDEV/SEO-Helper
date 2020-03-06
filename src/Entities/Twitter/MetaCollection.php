<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities\Twitter;

use Arcanedev\SeoHelper\Entities\AbstractMetaCollection;

/**
 * Class     MetaCollection
 *
 * @package  Arcanedev\SeoHelper\Entities\Twitter
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
    protected $prefix = 'twitter:';
}

<?php

declare(strict_types=1);

use Arcanedev\SeoHelper\Contracts\SeoHelper;

if ( ! function_exists('seo_helper')) {
    /**
     * Get the SeoHelper instance.
     *
     * @return SeoHelper
     */
    function seo_helper(): SeoHelper
    {
        return app(SeoHelper::class);
    }
}

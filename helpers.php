<?php

use Arcanedev\SeoHelper\Contracts\SeoHelper;

if ( ! function_exists('seo_helper')) {
    /**
     * Get the SeoHelper instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoHelper
     */
    function seo_helper(): SeoHelper
    {
        return app(SeoHelper::class);
    }
}

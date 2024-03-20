<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Traits;

use Arcanedev\SeoHelper\Contracts\{SeoHelper, SeoMeta, SeoOpenGraph, SeoTwitter};

/**
 * Trait     Seoable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait Seoable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the SeoHelper instance.
     */
    public function seo(): SeoHelper
    {
        return seo_helper();
    }

    /**
     * Get the SeoMeta instance.
     */
    public function seoMeta(): SeoMeta
    {
        return $this->seo()->meta();
    }

    /**
     * Get the SeoOpenGraph instance.
     */
    public function seoGraph(): SeoOpenGraph
    {
        return $this->seo()->openGraph();
    }

    /**
     * Get the SeoTwitter instance.
     */
    public function seoCard(): SeoTwitter
    {
        return $this->seo()->twitter();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the title.
     */
    public function setTitle(string $title, ?string $siteName = null, ?string $separator = null): SeoHelper
    {
        return $this->seo()->setTitle($title, $siteName, $separator);
    }

    /**
     * Set the description.
     */
    public function setDescription(string $description): SeoHelper
    {
        return $this->seo()->setDescription($description);
    }

    /**
     * Set the keywords.
     */
    public function setKeywords(array|string $keywords): SeoHelper
    {
        return $this->seo()->setKeywords($keywords);
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Traits;

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
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoHelper
     */
    public function seo()
    {
        return seo_helper();
    }

    /**
     * Get the SeoMeta instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoMeta
     */
    public function seoMeta()
    {
        return $this->seo()->meta();
    }

    /**
     * Get the SeoOpenGraph instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function seoGraph()
    {
        return $this->seo()->openGraph();
    }

    /**
     * Get the SeoTwitter instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoTwitter
     */
    public function seoCard()
    {
        return $this->seo()->twitter();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set title.
     *
     * @param  string       $title
     * @param  string|null  $siteName
     * @param  string|null  $separator
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoHelper
     */
    public function setTitle($title, $siteName = null, $separator = null)
    {
        return $this->seo()->setTitle($title, $siteName, $separator);
    }

    /**
     * Set description.
     *
     * @param  string  $description
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoHelper
     */
    public function setDescription($description)
    {
        return $this->seo()->setDescription($description);
    }

    /**
     * Set keywords.
     *
     * @param  array|string  $keywords
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoHelper
     */
    public function setKeywords($keywords)
    {
        return $this->seo()->setKeywords($keywords);
    }
}

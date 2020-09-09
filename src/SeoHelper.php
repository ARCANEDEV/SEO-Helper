<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoHelper as SeoHelperContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Contracts\SeoOpenGraph as SeoOpenGraphContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Illuminate\Support\HtmlString;

/**
 * Class     SeoHelper
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoHelper implements SeoHelperContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The SeoMeta instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\SeoMeta
     */
    private $seoMeta;

    /**
     * The SeoOpenGraph instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    private $seoOpenGraph;

    /**
     * The SeoTwitter instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\SeoTwitter
     */
    private $seoTwitter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoHelper instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoMeta       $seoMeta
     * @param  \Arcanedev\SeoHelper\Contracts\SeoOpenGraph  $seoOpenGraph
     * @param  \Arcanedev\SeoHelper\Contracts\SeoTwitter    $seoTwitter
     */
    public function __construct(
        SeoMetaContract $seoMeta, SeoOpenGraphContract $seoOpenGraph, SeoTwitterContract $seoTwitter
    ) {
        $this->setSeoMeta($seoMeta);
        $this->setSeoOpenGraph($seoOpenGraph);
        $this->setSeoTwitter($seoTwitter);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get SeoMeta instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoMeta
     */
    public function meta()
    {
        return $this->seoMeta;
    }

    /**
     * Set SeoMeta instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoMeta  $seoMeta
     *
     * @return $this
     */
    public function setSeoMeta(SeoMetaContract $seoMeta)
    {
        $this->seoMeta = $seoMeta;

        return $this;
    }

    /**
     * Get SeoOpenGraph instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function openGraph()
    {
        return $this->seoOpenGraph;
    }

    /**
     * Get SeoOpenGraph instance (alias).
     *
     * @see openGraph()
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoOpenGraph
     */
    public function og()
    {
        return $this->openGraph();
    }

    /**
     * Get SeoOpenGraph instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoOpenGraph  $seoOpenGraph
     *
     * @return $this
     */
    public function setSeoOpenGraph(SeoOpenGraphContract $seoOpenGraph)
    {
        $this->seoOpenGraph = $seoOpenGraph;

        return $this;
    }

    /**
     * Get SeoTwitter instance.
     *
     * @return \Arcanedev\SeoHelper\Contracts\SeoTwitter
     */
    public function twitter()
    {
        return $this->seoTwitter;
    }

    /**
     * Set SeoTwitter instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\SeoTwitter  $seoTwitter
     *
     * @return $this
     */
    public function setSeoTwitter(SeoTwitterContract $seoTwitter)
    {
        $this->seoTwitter = $seoTwitter;

        return $this;
    }

    /**
     * Set title.
     *
     * @param  string       $title
     * @param  string|null  $siteName
     * @param  string|null  $separator
     *
     * @return $this
     */
    public function setTitle($title, $siteName = null, $separator = null)
    {
        $this->meta()->setTitle($title, null, $separator);
        $this->openGraph()->setTitle($title);
        $this->twitter()->setTitle($title);

        return $this->setSiteName($siteName);
    }

    /**
     * Set the site name.
     *
     * @param  string  $siteName
     *
     * @return self
     */
    public function setSiteName($siteName)
    {
        $this->meta()->setSiteName($siteName);
        $this->openGraph()->setSiteName($siteName);

        return $this;
    }

    /**
     * Hide the site name.
     *
     * @return self
     */
    public function hideSiteName()
    {
        $this->meta()->hideSiteName();

        return $this;
    }

    /**
     * Show the site name.
     *
     * @return self
     */
    public function showSiteName()
    {
        $this->meta()->showSiteName();

        return $this;
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
        $this->meta()->setDescription($description);
        $this->openGraph()->setDescription($description);
        $this->twitter()->setDescription($description);

        return $this;
    }

    /**
     * Set keywords.
     *
     * @param  array|string  $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->meta()->setKeywords($keywords);

        return $this;
    }

    /**
     * Set Image.
     *
     * @param  string  $imageUrl
     *
     * @return $this
     */
    public function setImage($imageUrl)
    {
        $this->openGraph()->setImage($imageUrl);
        $this->twitter()->addImage($imageUrl);

        return $this;
    }

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->meta()->setUrl($url);
        $this->openGraph()->setUrl($url);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, array_filter([
            $this->meta()->render(),
            $this->openGraph()->render(),
            $this->twitter()->render(),
        ]));
    }

    /**
     * Render all seo tags with HtmlString object.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function renderHtml()
    {
        return new HtmlString(
            $this->render()
        );
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Enable the OpenGraph.
     *
     * @return $this
     */
    public function enableOpenGraph()
    {
        $this->openGraph()->enable();

        return $this;
    }

    /**
     * Disable the OpenGraph.
     *
     * @return $this
     */
    public function disableOpenGraph()
    {
        $this->openGraph()->disable();

        return $this;
    }

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enableTwitter()
    {
        $this->twitter()->enable();

        return $this;
    }

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disableTwitter()
    {
        $this->twitter()->disable();

        return $this;
    }
}

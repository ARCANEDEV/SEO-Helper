<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Keywords as KeywordsContract;
use Arcanedev\SeoHelper\Contracts\Entities\MiscTags as MiscTagsContract;
use Arcanedev\SeoHelper\Contracts\Entities\Title as TitleContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;
use Arcanedev\SeoHelper\Contracts\SeoMeta as SeoMetaContract;
use Arcanedev\SeoHelper\Entities\Analytics;
use Arcanedev\SeoHelper\Entities\Description;
use Arcanedev\SeoHelper\Entities\Keywords;
use Arcanedev\SeoHelper\Entities\MiscTags;
use Arcanedev\SeoHelper\Entities\Title;
use Arcanedev\SeoHelper\Entities\Webmasters;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     SeoMeta
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMeta implements SeoMetaContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Configurable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Current URL.
     */
    protected string $currentUrl = '';

    /**
     * The Title instance.
     */
    protected TitleContract $title;

    /**
     * The Description instance.
     */
    protected DescriptionContract $description;

    /**
     * The Keywords instance.
     */
    protected KeywordsContract $keywords;

    /**
     * The MiscTags instance.
     */
    protected MiscTagsContract $misc;

    /**
     * The Webmasters instance.
     */
    protected WebmastersContract $webmasters;

    /**
     * The Analytics instance.
     */
    protected AnalyticsContract $analytics;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoMeta instance.
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);
        $this->init();
    }

    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Title instance.
     *
     * @return $this
     */
    public function title(TitleContract $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the Title instance.
     */
    public function getTitleEntity(): TitleContract
    {
        return $this->title;
    }

    /**
     * Set the Description instance.
     *
     * @return $this
     */
    public function description(DescriptionContract $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the Description instance.
     */
    public function getDescriptionEntity(): DescriptionContract
    {
        return $this->description;
    }

    /**
     * Set the Keywords instance.
     *
     * @return $this
     */
    public function keywords(KeywordsContract $keywords): static
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get the Keywords instance.
     */
    public function getKeywordsEntity(): KeywordsContract
    {
        return $this->keywords;
    }

    /**
     * Set the MiscTags instance.
     *
     * @return $this
     */
    public function misc(MiscTagsContract $misc): static
    {
        $this->misc = $misc;

        return $this;
    }

    /**
     * Get the MiscTags instance.
     */
    public function getMiscEntity(): MiscTagsContract
    {
        return $this->misc;
    }

    /**
     * Set the Webmasters instance.
     *
     * @return $this
     */
    public function webmasters(WebmastersContract $webmasters): static
    {
        $this->webmasters = $webmasters;

        return $this;
    }

    /**
     * Get the Webmasters instance.
     */
    public function getWebmastersEntity(): WebmastersContract
    {
        return $this->webmasters;
    }

    /**
     * Set the Analytics instance.
     *
     * @return $this
     */
    public function analytics(AnalyticsContract $analytics): static
    {
        $this->analytics = $analytics;

        return $this;
    }

    /**
     * Get the Analytics instance.
     */
    public function getAnalyticsEntity(): AnalyticsContract
    {
        return $this->analytics;
    }

    /**
     * Set the title.
     *
     * @return $this
     */
    public function setTitle(string $title, ?string $siteName = null, ?string $separator = null): static
    {
        $this->title
            ->set($title)
            ->setSeparator($separator)
            ->setSiteName($siteName)
        ;

        return $this;
    }

    /**
     * Set the site name.
     *
     * @return $this
     */
    public function setSiteName(string $siteName): static
    {
        $this->title->setSiteName($siteName);

        return $this;
    }

    /**
     * Hide site name.
     *
     * @return $this
     */
    public function hideSiteName(): static
    {
        $this->title->hideSiteName();

        return $this;
    }

    /**
     * Show site name.
     *
     * @return $this
     */
    public function showSiteName(): static
    {
        $this->title->showSiteName();

        return $this;
    }

    /**
     * Set the description content.
     *
     * @return $this
     */
    public function setDescription(string $content): static
    {
        $this->description->set($content);

        return $this;
    }

    /**
     * Set the keywords content.
     *
     * @return $this
     */
    public function setKeywords(array|string $content): static
    {
        $this->keywords->set($content);

        return $this;
    }

    /**
     * Add a keyword.
     *
     * @return $this
     */
    public function addKeyword(string $keyword): static
    {
        $this->keywords->add($keyword);

        return $this;
    }

    /**
     * Add many keywords.
     *
     * @return $this
     */
    public function addKeywords(array $keywords): static
    {
        $this->keywords->addMany($keywords);

        return $this;
    }

    /**
     * Add a webmaster tool site verifier.
     *
     * @return $this
     */
    public function addWebmaster(string $webmaster, string $content): static
    {
        $this->webmasters->add($webmaster, $content);

        return $this;
    }

    /**
     * Set the current URL.
     *
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->currentUrl = $url;
        $this->misc->setUrl($url);

        return $this;
    }

    /**
     * Set the Google Analytics code.
     *
     * @return $this
     */
    public function setGoogleAnalytics(string $code): static
    {
        $this->analytics->setGoogle($code);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add a meta tag.
     *
     * @return $this
     */
    public function addMeta(string $name, string $content): static
    {
        $this->misc->add($name, $content);

        return $this;
    }

    /**
     * Add many meta tags.
     *
     * @return $this
     */
    public function addMetas(array $metas): static
    {
        $this->misc->addMany($metas);

        return $this;
    }

    /**
     * Remove a meta from the meta collection by key.
     *
     * @return $this
     */
    public function removeMeta(array|string $names): static
    {
        $this->misc->remove($names);

        return $this;
    }

    /**
     * Reset the meta collection except the description and keywords metas.
     *
     * @return $this
     */
    public function resetMetas(): static
    {
        $this->misc->reset();

        return $this;
    }

    /**
     * Reset all webmaster tool site verifier metas.
     *
     * @return $this
     */
    public function resetWebmasters(): static
    {
        $this->webmasters->reset();

        return $this;
    }

    /**
     * Render all seo tags.
     */
    public function render(): string
    {
        return implode(PHP_EOL, array_filter([
            $this->title->render(),
            $this->description->render(),
            $this->keywords->render(),
            $this->misc->render(),
            $this->webmasters->render(),
            $this->analytics->render(),
        ]));
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        $this
            ->title(new Title($this->getConfig('title', [])))
            ->description(new Description($this->getConfig('description', [])))
            ->keywords(new Keywords($this->getConfig('keywords', [])))
            ->misc(new MiscTags($this->getConfig('misc', [])))
            ->webmasters(new Webmasters($this->getConfig('webmasters', [])))
            ->analytics(new Analytics($this->getConfig('analytics', [])))
        ;
    }
}

<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollection as MetaCollectionContract;
use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Webmasters
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Webmasters implements WebmastersContract
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
     * The supported webmasters.
     */
    protected array $supported = [
        'google'    => 'google-site-verification',
        'bing'      => 'msvalidate.01',
        'alexa'     => 'alexaVerifyID',
        'pinterest' => 'p:domain_verify',
        'yandex'    => 'yandex-verification'
    ];

    /**
     * The meta collection.
     */
    protected MetaCollectionContract $metas;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create Webmasters instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->reset();
        $this->init();
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make Webmaster instance.
     *
     * @return $this
     */
    public static function make(array $webmasters = []): static
    {
        return new static($webmasters);
    }

    /**
     * Get all the metas' collection.
     */
    public function all(): MetaCollectionContract
    {
        return $this->metas;
    }

    /**
     * Add a webmaster to collection.
     *
     * @return $this
     */
    public function add(string $webmaster, string $content): static
    {
        if (($name = $this->getWebmasterName($webmaster)) !== null) {
            $this->metas->addOne($name, $content);
        }

        return $this;
    }

    /**
     * Reset the webmaster collection.
     *
     * @return $this
     */
    public function reset(): static
    {
        $this->metas = new MetaCollection();

        return $this;
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this->metas->render();
    }

    /**
     * Start the engine.
     */
    private function init(): void
    {
        foreach ($this->configs as $webmaster => $content) {
            $this->add($webmaster, $content);
        }
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the webmaster meta name.
     */
    private function getWebmasterName(string $webmaster): ?string
    {
        return $this->isSupported($webmaster)
            ? $this->supported[$webmaster]
            : null;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the webmaster is supported.
     */
    private function isSupported(string $webmaster): bool
    {
        return array_key_exists($webmaster, $this->supported);
    }
}

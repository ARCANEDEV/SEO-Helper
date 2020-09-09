<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     SeoTwitter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoTwitter implements SeoTwitterContract
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
     * Enable or Disable the Twitter Card.
     *
     * @var bool
     */
    protected $enabled;

    /**
     * The Twitter Card instance.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard
     */
    protected $card;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make SeoTwitter instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);

        $this->setEnabled($this->getConfig('twitter.enabled', false));
        $this->setCard(
            new Entities\Twitter\Card($this->getConfig('twitter', []))
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Twitter Card instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\TwitterCard  $card
     *
     * @return $this
     */
    public function setCard(CardContract $card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->card->setType($type);

        return $this;
    }

    /**
     * Set the card site.
     *
     * @param  string  $site
     *
     * @return $this
     */
    public function setSite($site)
    {
        $this->card->setSite($site);

        return $this;
    }

    /**
     * Set the card title.
     *
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->card->setTitle($title);

        return $this;
    }

    /**
     * Set the card description.
     *
     * @param  string  $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->card->setDescription($description);

        return $this;
    }

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function addImage($url)
    {
        $this->card->addImage($url);

        return $this;
    }

    /**
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return $this
     */
    public function addMetas(array $metas)
    {
        $this->card->addMetas($metas);

        return $this;
    }

    /**
     * Add a meta to the Twitter Card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return $this
     */
    public function addMeta($name, $content)
    {
        $this->card->addMeta($name, $content);

        return $this;
    }

    /**
     * Set the enabled status for the Twitter Card.
     *
     * @param  bool  $enabled
     *
     * @return $this
     */
    private function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Reset the Twitter Card.
     *
     * @return $this
     */
    public function reset()
    {
        $this->card->reset();

        return $this;
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->isEnabled() ? $this->card->render() : '';
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
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enable()
    {
        return $this->setEnabled(true);
    }

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disable()
    {
        return $this->setEnabled(false);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the Twitter Card is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Check if the Twitter Card is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return ! $this->isEnabled();
    }
}

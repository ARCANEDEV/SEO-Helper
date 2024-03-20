<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;
use Arcanedev\SeoHelper\Contracts\SeoTwitter as SeoTwitterContract;
use Arcanedev\SeoHelper\Entities\Twitter\Card;
use Arcanedev\SeoHelper\Traits\Configurable;
use Arcanedev\SeoHelper\Traits\HasEnabled;

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
    use HasEnabled;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The Twitter Card instance.
     */
    protected CardContract $card;

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
        $this->setCard(new Card($this->getConfig('twitter', [])));
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
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the Twitter Card instance.
     *
     * @return $this
     */
    public function setCard(CardContract $card): static
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Set the card type.
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->card->setType($type);

        return $this;
    }

    /**
     * Set the card site.
     *
     * @return $this
     */
    public function setSite(string $site): static
    {
        $this->card->setSite($site);

        return $this;
    }

    /**
     * Set the card title.
     *
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->card->setTitle($title);

        return $this;
    }

    /**
     * Set the card description.
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->card->setDescription($description);

        return $this;
    }

    /**
     * Add image to the card.
     *
     * @return $this
     */
    public function addImage(string $url): static
    {
        $this->card->addImage($url);

        return $this;
    }

    /**
     * Add many metas to the card.
     *
     * @return $this
     */
    public function addMetas(array $metas): static
    {
        $this->card->addMetas($metas);

        return $this;
    }

    /**
     * Add a meta to the Twitter Card.x
     *
     * @return $this
     */
    public function addMeta(string $name, string $content): static
    {
        $this->card->addMeta($name, $content);

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
    public function reset(): static
    {
        $this->card->reset();

        return $this;
    }

    /**
     * Render the tag.
     */
    public function render(): string
    {
        return $this->isEnabled() ? $this->card->render() : '';
    }
}

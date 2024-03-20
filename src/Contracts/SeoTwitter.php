<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;

/**
 * Interface  SeoTwitter
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoTwitter extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the twitter card instance.
     *
     * @return $this
     */
    public function setCard(CardContract $card): static;

    /**
     * Set the card type.
     *
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * Set the card site.
     *
     * @return $this
     */
    public function setSite(string $site): static;

    /**
     * Set the card title.
     *
     * @return $this
     */
    public function setTitle(string $title): static;

    /**
     * Set the card description.
     *
     * @return $this
     */
    public function setDescription(string $description): static;

    /**
     * Add the image to the card.
     *
     * @return $this
     */
    public function addImage(string $url): static;

    /**
     * Add many metas to the card.
     *
     * @return $this
     */
    public function addMetas(array $metas): static;

    /**
     * Add a meta to the twitter card.
     *
     * @return $this
     */
    public function addMeta(string $name, string $content): static;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Reset the twitter card.
     *
     * @return $this
     */
    public function reset(): static;

    /**
     * Enable the Twitter Card.
     *
     * @return $this
     */
    public function enable(): static;

    /**
     * Disable the Twitter Card.
     *
     * @return $this
     */
    public function disable(): static;

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the Twitter Card is enabled.
     */
    public function isEnabled(): bool;

    /**
     * Check if the Twitter Card is disabled.
     */
    public function isDisabled(): bool;
}

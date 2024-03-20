<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  TwitterCard
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TwitterCard extends Renderable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const TYPE_APP                 = 'app';
    public const TYPE_GALLERY             = 'gallery';
    public const TYPE_PHOTO               = 'photo';
    public const TYPE_PLAYER              = 'player';
    public const TYPE_PRODUCT             = 'product';
    public const TYPE_SUMMARY             = 'summary';
    public const TYPE_SUMMARY_LARGE_IMAGE = 'summary_large_image';

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
     * Add a meta to the card.
     *
     * @return $this
     */
    public function addMeta(string $name, array|string $content): static;

    /**
     * Get all supported card types.
     */
    public function types(): array;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Reset the card.
     *
     * @return $this
     */
    public function reset(): static;
}

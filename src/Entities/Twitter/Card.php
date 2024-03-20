<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities\Twitter;

use Arcanedev\SeoHelper\Contracts\Entities\MetaCollection as MetaCollectionContract;
use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;
use Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException;
use Arcanedev\SeoHelper\Traits\Configurable;
use Illuminate\Support\Str;

/**
 * Class     Card
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Card implements CardContract
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
     * Card type.
     */
    protected string $type;

    /**
     * Card meta collection.
     */
    protected MetaCollectionContract $metas;

    /**
     * Card images.
     */
    protected array $images  = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make the twitter card instance.
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas = new MetaCollection();

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

    /**
     * Set the card type.
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        if (empty($type)) {
            return $this;
        }

        $this->checkType($type);
        $this->type = $type;

        return $this->addMeta('card', $type);
    }

    /**
     * Set the card site.
     *
     * @return $this
     */
    public function setSite(string $site): static
    {
        if (empty($site)) {
            return $this;
        }

        $this->checkSite($site);

        return $this->addMeta('site', $site);
    }

    /**
     * Set the card title.
     *
     * @return $this
     */
    public function setTitle(string $title): static
    {
        return $this->addMeta('title', $title);
    }

    /**
     * Set the card description.
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->addMeta('description', $description);
    }

    /**
     * Add the image to the card.
     *
     * @return $this
     */
    public function addImage(string $url): static
    {
        if (count($this->images) < 4) {
            $this->images[] = $url;
        }

        return $this;
    }

    /**
     * Add many metas to the card.
     *
     * @return $this
     */
    public function addMetas(array $metas): static
    {
        $this->metas->addMany($metas);

        return $this;
    }

    /**
     * Add a meta to the card.
     *
     * @return $this
     */
    public function addMeta(string $name, array|string $content): static
    {
        $this->metas->addOne($name, $content);

        return $this;
    }

    /**
     * Get all supported card types.
     */
    public function types(): array
    {
        return [
            static::TYPE_APP,
            static::TYPE_GALLERY,
            static::TYPE_PHOTO,
            static::TYPE_PLAYER,
            static::TYPE_PRODUCT,
            static::TYPE_SUMMARY,
            static::TYPE_SUMMARY_LARGE_IMAGE,
        ];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Reset the card.
     *
     * @return $this
     */
    public function reset(): static
    {
        $this->metas->reset();
        $this->images = [];

        return $this->init();
    }

    /**
     * Render the twitter card.
     */
    public function render(): string
    {
        if ( ! empty($this->images)) {
            $this->loadImages();
        }

        return $this->metas->render();
    }

    /**
     * Start the engine.
     *
     * @return $this
     */
    private function init(): static
    {
        return $this
            ->setPrefix($this->getConfig('prefix', 'twitter:'))
            ->setType($this->getConfig('card', static::TYPE_SUMMARY))
            ->setSite($this->getConfig('site', ''))
            ->setTitle($this->getConfig('title', ''))
            ->addMetas($this->getConfig('metas', []))
        ;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set meta prefix name.
     *
     * @return $this
     */
    private function setPrefix(string $prefix): static
    {
        $this->metas->setPrefix($prefix);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the card type.
     *
     * @throws InvalidTwitterCardException
     */
    private function checkType(string &$type): void
    {
        $type = mb_strtolower(trim($type));

        if ( ! in_array($type, $this->types())) {
            throw new InvalidTwitterCardException("The Twitter card type [{$type}] is not supported.");
        }
    }

    /**
     * Check the card site.
     */
    private function checkSite(string &$site): void
    {
        $site = $this->prepareUsername($site);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render card images.
     */
    private function loadImages(): void
    {
        if (count($this->images) === 1) {
            $this->addMeta('image', $this->images[0]);

            return;
        }

        foreach ($this->images as $number => $url) {
            $this->addMeta("image{$number}", $url);
        }
    }

    /**
     * Prepare username.
     */
    private function prepareUsername(string $username): string
    {
        return Str::startsWith($username, '@') ? $username : "@{$username}";
    }
}

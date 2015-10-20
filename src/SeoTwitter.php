<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCardInterface;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     SeoTwitter
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://dev.twitter.com/cards/overview
 */
class SeoTwitter implements Contracts\SeoTwitter
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Configurable;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Twitter Card instance.
     *
     * @var TwitterCardInterface
     */
    protected $card;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoTwitter instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);

        $this->setCard(
            new Entities\Twitter\Card($this->getConfig('twitter', []))
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the twitter card instance.
     *
     * @param  \Arcanedev\SeoHelper\Contracts\Entities\TwitterCardInterface  $card
     *
     * @return self
     */
    public function setCard(TwitterCardInterface $card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function addMetas(array $metas)
    {
        $this->card->addMetas($metas);

        return $this;
    }

    /**
     * Add a meta to the twitter card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return self
     */
    public function addMeta($name, $content)
    {
        $this->card->addMeta($name, $content);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Reset the twitter card.
     *
     * @return self
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
        return $this->card->render();
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
}

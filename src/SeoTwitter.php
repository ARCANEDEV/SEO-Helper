<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\Twitter\CardInterface;

/**
 * Class     SeoTwitter
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://dev.twitter.com/cards/overview
 */
class SeoTwitter extends Bases\Seo implements Contracts\SeoTwitter
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CardInterface */
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
        parent::__construct($configs);

        $this->card = new Entities\Twitter\Card($this->getConfig('twitter', []));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
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
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->card->render();
    }

    /**
     * Reset the twitter card.
     *
     * @return self
     */
    public function reset()
    {
        return $this->card->reset();
    }
}

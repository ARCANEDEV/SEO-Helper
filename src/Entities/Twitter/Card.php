<?php namespace Arcanedev\SeoHelper\Entities\Twitter;

use Arcanedev\SeoHelper\Contracts\Entities\TwitterCard as CardContract;
use Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Card
 *
 * @package  Arcanedev\SeoHelper\Entities\Twitter
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Card implements CardContract
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
     * Card type.
     *
     * @var string
     */
    protected $type;

    /**
     * Card meta collection.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    protected $metas;

    /**
     * Card images.
     *
     * @var array
     */
    protected $images  = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the twitter card instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->metas = new MetaCollection;

        $this->init();
    }

    /**
     * Start the engine.
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    private function init()
    {
        $this->setPrefix($this->getConfig('prefix', 'twitter:'));
        $this->setType($this->getConfig('card', static::TYPE_SUMMARY));
        $this->setSite($this->getConfig('site', ''));
        $this->setTitle($this->getConfig('title', ''));
        $this->addMetas($this->getConfig('metas', []));

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set meta prefix name.
     *
     * @param  string  $prefix
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    private function setPrefix($prefix)
    {
        $this->metas->setPrefix($prefix);

        return $this;
    }

    /**
     * Set the card type.
     *
     * @param  string  $type
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function setType($type)
    {
        if (empty($type)) return $this;

        $this->checkType($type);
        $this->type = $type;

        return $this->addMeta('card', $type);
    }

    /**
     * Set card site.
     *
     * @param  string  $site
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function setSite($site)
    {
        if (empty($site)) return $this;

        $this->checkSite($site);

        return $this->addMeta('site', $site);
    }

    /**
     * Set card title.
     *
     * @param  string  $title
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function setTitle($title)
    {
        return $this->addMeta('title', $title);
    }

    /**
     * Set card description.
     *
     * @param  string  $description
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function setDescription($description)
    {
        return $this->addMeta('description', $description);
    }

    /**
     * Add image to the card.
     *
     * @param  string  $url
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function addImage($url)
    {
        if (count($this->images) < 4) {
            $this->images[] = $url;
        }

        return $this;
    }

    /**
     * Add many metas to the card.
     *
     * @param  array  $metas
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function addMetas(array $metas)
    {
        $this->metas->addMany($metas);

        return $this;
    }

    /**
     * Add a meta to the card.
     *
     * @param  string  $name
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function addMeta($name, $content)
    {
        $this->metas->add($name, $content);

        return $this;
    }

    /**
     * Get all supported card types.
     *
     * @return array
     */
    public function types()
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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render card images.
     */
    private function loadImages()
    {
        if (count($this->images) == 1) {
            $this->addMeta('image', $this->images[0]);

            return;
        }

        foreach ($this->images as $number => $url) {
            $this->addMeta("image{$number}", $url);
        }
    }

    /**
     * Reset the card.
     *
     * @return \Arcanedev\SeoHelper\Entities\Twitter\Card
     */
    public function reset()
    {
        $this->metas->reset();
        $this->images = [];

        return $this->init();
    }

    /**
     * Render the twitter card.
     *
     * @return string
     */
    public function render()
    {
        if ( ! empty($this->images)) {
            $this->loadImages();
        }

        return $this->metas->render();
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

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check the card type.
     *
     * @param  string  $type
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException
     */
    private function checkType(&$type)
    {
        if ( ! is_string($type)) {
            throw new InvalidTwitterCardException(
                'The Twitter card type must be a string value, [' . gettype($type) . '] was given.'
            );
        }

        $type = strtolower(trim($type));

        if ( ! in_array($type, $this->types())) {
            throw new InvalidTwitterCardException("The Twitter card type [$type] is not supported.");
        }
    }

    /**
     * Check the card site.
     *
     * @param  string  $site
     */
    private function checkSite(&$site)
    {
        $site = $this->prepareUsername($site);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Prepare username.
     *
     * @param  string  $username
     *
     * @return string
     */
    private function prepareUsername($username)
    {
        if ( ! starts_with($username, '@')) {
            $username = '@' . $username;
        }

        return $username;
    }
}

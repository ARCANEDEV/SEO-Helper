<?php namespace Arcanedev\SeoHelper\Entities\Twitter;

use Arcanedev\SeoHelper\Contracts\Renderable;
use Arcanedev\SeoHelper\Exceptions\InvalidTwitterCardException;

/**
 * Class     Card
 *
 * @package  Arcanedev\SeoHelper\Entities\Twitter
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Card implements Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Card type.
     *
     * @var string
     */
    protected $type   = 'summary';

    /**
     * Card meta collection.
     *
     * @var MetaCollection
     */
    protected $metas;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the twitter card instance.
     *
     * @param  array  $config
     */
    public function __construct(array $config = [])
    {
        $this->metas = new MetaCollection;
        $this->setPrefix(array_get($config, 'prefix', 'twitter:'));
        $this->setType(array_get($config, 'card', 'summary'));
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
     * @return self
     */
    private function setPrefix($prefix)
    {
        $this->metas->setPrefix($prefix);

        return $this;
    }

    /**
     *
     * @param  string  $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->checkType($type);

        $this->type = $type;
        $this->metas->add('card', $type);

        return $this;
    }

    /**
     * Set card site.
     *
     * @param  string  $site
     *
     * @return self
     */
    public function setSite($site)
    {
        $this->checkSite($site);
        $this->metas->add('site', $site);

        return $this;
    }

    /**
     * Set card title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->metas->add('title', $title);

        return $this;
    }

    /**
     * Set card description.
     *
     * @param  string  $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->metas->add('description', $description);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the twitter card.
     *
     * @return string
     */
    public function render()
    {
        return $this->metas->render();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if type is supported.
     *
     * @param  string  $type
     *
     * @return bool
     */
    private function isSupportedType($type)
    {
        return in_array($type, [
            'app', 'gallery', 'photo', 'player', 'product', 'summary', 'summary_large_image'
        ]);
    }

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

        if ( ! $this->isSupportedType($type)) {
            throw new InvalidTwitterCardException(
                "The Twitter card type [$type] is not supported."
            );
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

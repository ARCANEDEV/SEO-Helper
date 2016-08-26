<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Webmasters as WebmastersContract;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Webmasters
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Webmasters implements WebmastersContract
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
     * The supported webmasters.
     *
     * @var array
     */
    protected $supported = [
        'google'    => 'google-site-verification',
        'bing'      => 'msvalidate.01',
        'alexa'     => 'alexaVerifyID',
        'pinterest' => 'p:domain_verify',
        'yandex'    => 'yandex-verification'
    ];

    /**
     * The meta collection.
     *
     * @var \Arcanedev\SeoHelper\Contracts\Entities\MetaCollection
     */
    protected $metas;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create Webmasters instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);

        $this->reset();
        $this->init();
    }

    /**
     * Start the engine.
     */
    private function init()
    {
        foreach ($this->configs as $webmaster => $content) {
            $this->add($webmaster, $content);
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the webmaster meta name.
     *
     * @param  string  $webmaster
     *
     * @return string
     */
    private function getWebmasterName($webmaster)
    {
        if ($this->isSupported($webmaster)) {
            return $this->supported[$webmaster];
        }

        return null;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Webmaster instance.
     *
     * @param  array  $webmasters
     *
     * @return \Arcanedev\SeoHelper\Entities\Webmasters
     */
    public static function make(array $webmasters = [])
    {
        return new self($webmasters);
    }

    /**
     * Add a webmaster to collection.
     *
     * @param  string  $webmaster
     * @param  string  $content
     *
     * @return \Arcanedev\SeoHelper\Entities\Webmasters
     */
    public function add($webmaster, $content)
    {
        if ( ! is_null($name = $this->getWebmasterName($webmaster))) {
            $this->metas->add($name, $content);
        }

        return $this;
    }

    /**
     * Reset the webmaster collection.
     *
     * @return \Arcanedev\SeoHelper\Entities\Webmasters
     */
    public function reset()
    {
        $this->metas = new MetaCollection;

        return $this;
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
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
     * Check if the webmaster is supported.
     *
     * @param  string  $webmaster
     *
     * @return bool
     */
    private function isSupported($webmaster)
    {
        return array_key_exists($webmaster, $this->supported);
    }
}

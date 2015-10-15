<?php namespace Arcanedev\SeoHelper\Traits;

/**
 * Trait     Configurable
 *
 * @package  Arcanedev\SeoHelper\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait Configurable
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Config items.
     *
     * @var array
     */
    protected $configs = [];

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the config array.
     *
     * @param  array  $configs
     *
     * @return self
     */
    protected function setConfigs(array $configs)
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * Get a config item.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return array_get($this->configs, $key, $default);
    }
}

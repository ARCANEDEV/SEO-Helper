<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Traits;

use Illuminate\Support\Arr;

/**
 * Trait     Configurable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait Configurable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var array */
    protected $configs = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the configs.
     *
     * @param  array  $configs
     *
     * @return $this
     */
    protected function setConfigs(array $configs)
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * @param  string      $name
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function getConfig($name, $default = null)
    {
        return Arr::get($this->configs, $name, $default);
    }
}

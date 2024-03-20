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

    protected array $configs = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get a config value.
     */
    public function getConfig(string $name, mixed $default = null): mixed
    {
        return Arr::get($this->configs, $name, $default);
    }

    /**
     * Set the configs.
     *
     * @return $this
     */
    protected function setConfigs(array $configs): static
    {
        $this->configs = $configs;

        return $this;
    }
}

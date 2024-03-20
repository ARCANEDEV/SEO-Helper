<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Traits;

trait HasEnabled
{
    /**
     * Enable or Disable the OpenGraph.
     */
    protected bool $enabled;

    /**
     * Enable the instance.
     *
     * @return $this
     */
    public function enable(): static
    {
        return $this->setEnabled(true);
    }

    /**
     * Disable the instance.
     *
     * @return $this
     */
    public function disable(): static
    {
        return $this->setEnabled(false);
    }

    /**
     * Check if the instance is enabled.
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Check if the instance is disabled.
     */
    public function isDisabled(): bool
    {
        return ! $this->isEnabled();
    }

    /**
     * Set the enabled status for the instance.
     *
     * @return $this
     */
    protected function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }
}

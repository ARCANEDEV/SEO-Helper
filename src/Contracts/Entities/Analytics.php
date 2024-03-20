<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts\Entities;

use Arcanedev\SeoHelper\Contracts\Renderable;

/**
 * Interface  Analytics
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Analytics extends Renderable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set Google Analytics code.
     *
     * @param string $code
     *
     * @return $this
     */
    public function setGoogle(string $code): static;
}

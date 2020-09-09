<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  Renderable
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Renderable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Render the tag.
     *
     * @return string
     */
    public function render();

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString();
}

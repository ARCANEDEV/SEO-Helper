<?php namespace Arcanedev\SeoHelper\Contracts;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;

/**
 * Interface  SeoOpenGraph
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoOpenGraph extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the Open Graph instance.
     *
     * @param  OpenGraphInterface  $openGraph
     *
     * @return self
     */
    public function setOpenGraph(OpenGraphInterface $openGraph);
}

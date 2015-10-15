<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     SeoOpenGraph
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoOpenGraph implements Contracts\SeoOpenGraph
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
     * The Open Graph instance.
     *
     * @var OpenGraphInterface
     */
    protected $openGraph;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoOpenGraph instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->setConfigs($configs);

        $this->setOpenGraph(
            new Entities\OpenGraph\Graph($this->getConfig('open-graph', []))
        );
    }

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
    public function setOpenGraph(OpenGraphInterface $openGraph)
    {
        $this->openGraph = $openGraph;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return $this->openGraph->render();
    }
}

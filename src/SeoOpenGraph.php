<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\Entities\OpenGraphInterface;
use Arcanedev\Support\Traits\Configurable;

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

    /**
     * Set the open graph prefix.
     *
     * @param  string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix)
    {
        $this->openGraph->setPrefix($prefix);

        return $this;
    }

    /**
     * Set type property.
     *
     * @param  string $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->openGraph->setType($type);

        return $this;
    }

    /**
     * Set title property.
     *
     * @param  string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->openGraph->setTitle($title);

        return $this;
    }

    /**
     * Set description property.
     *
     * @param  string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->openGraph->setDescription($description);

        return $this;
    }

    /**
     * Set url property.
     *
     * @param  string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->openGraph->setUrl($url);

        return $this;
    }

    /**
     * Set image property.
     *
     * @param  string $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->openGraph->setImage($image);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string $property
     * @param  string $content
     *
     * @return self
     */
    public function addProperty($property, $content)
    {
        $this->openGraph->addProperty($property, $content);

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

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}

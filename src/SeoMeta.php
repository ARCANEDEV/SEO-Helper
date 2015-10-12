<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoMetaInterface;
use Arcanedev\SeoHelper\Entities\Description;
use Arcanedev\SeoHelper\Entities\Title;
use Illuminate\Config\Repository as Config;

/**
 * Class     SeoMeta
 *
 * @package  Arcanedev\SeoHelper
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMeta implements SeoMetaInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Title instance.
     *
     * @var  Title
     */
    protected $title;

    /**
     * Description instance.
     *
     * @var  Description
     */
    protected $description;

    /**
     * Illuminate Config repository.
     *
     * @var Config
     */
    private $config;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make SeoMeta instance.
     *
     * @param  Config  $config
     */
    public function __construct(Config $config)
    {
        $this->config      = $config;
        $this->title       = new Title($this->config->get('seo-helper.title'));
        $this->description = new Description($this->config->get('seo-helper.description'));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title->getTitle();
    }

    /**
     * Set title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null)
    {
        $this->title->setTitle($title);

        if ( ! is_null($siteName)) {
            $this->title->setSiteName($siteName);
        }

        if ( ! is_null($separator)) {
            $this->title->setSeparator($separator);
        }

        return $this;
    }

    /**
     * Get description content.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description->getContent();
    }

    /**
     * Set description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function setDescription($content)
    {
        $this->description->setContent($content);

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        $tags = [
            $this->renderTitle(),
            $this->renderDescription(),
        ];

        return implode(PHP_EOL, array_filter($tags));
    }

    /**
     * Render title tag.
     *
     * @return string
     */
    public function renderTitle()
    {
        return $this->title->render();
    }

    /**
     * Render description tag.
     *
     * @return string
     */
    public function renderDescription()
    {
        return $this->description->render();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
}

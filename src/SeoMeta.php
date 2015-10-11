<?php namespace Arcanedev\SeoHelper;

use Arcanedev\SeoHelper\Contracts\SeoMetaInterface;
use Arcanedev\SeoHelper\Entities\TitleTag;
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
     * Title tag instance.
     *
     * @var  TitleTag
     */
    protected $title;

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
        $this->config = $config;
        $this->title  = new TitleTag($this->config->get('seo-helper.title'));
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
        return implode(PHP_EOL, [
            $this->renderTitle(),
        ]);
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
}

<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\DescriptionInterface;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Description
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Description implements DescriptionInterface
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
     * The meta name.
     *
     * @var string
     */
    protected $name    = 'description';

    /**
     * The meta content.
     *
     * @var string
     */
    protected $content = '';

    /**
     * The description max length.
     *
     * @var int
     */
    protected $max     = 155;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make Description instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
        $this->setContent($this->getConfig('default', ''));
        $this->setMax($this->getConfig('max', 55));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return str_limit($this->content, $this->getMax());
    }

    /**
     * Set description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = trim($content);

        return $this;
    }

    /**
     * Get description max length.
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set description max length.
     *
     * @param  int  $max
     *
     * @return self
     */
    public function setMax($max)
    {
        $this->checkMax($max);

        $this->max = $max;

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
        if ( ! $this->hasContent()) {
            return '';
        }

        return Meta::make($this->name, $this->getContent())->render();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if description has content.
     *
     * @return bool
     */
    private function hasContent()
    {
        return ! empty($this->getContent());
    }

    /**
     * Check title max length.
     *
     * @param  int  $max
     *
     * @throws \Arcanedev\SeoHelper\Exceptions\InvalidArgumentException
     */
    private function checkMax($max)
    {
        if ( ! is_int($max)) {
            throw new InvalidArgumentException(
                'The description maximum lenght must be integer.'
            );
        }

        if ($max <= 0) {
            throw new InvalidArgumentException(
                'The description maximum lenght must be greater 0.'
            );
        }
    }
}

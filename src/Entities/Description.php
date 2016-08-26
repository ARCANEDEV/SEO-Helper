<?php namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Description as DescriptionContract;
use Arcanedev\SeoHelper\Exceptions\InvalidArgumentException;
use Arcanedev\SeoHelper\Helpers\Meta;
use Arcanedev\Support\Traits\Configurable;

/**
 * Class     Description
 *
 * @package  Arcanedev\SeoHelper\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Description implements DescriptionContract
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
        $this->set($this->getConfig('default', ''));
        $this->setMax($this->getConfig('max', 155));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get raw description content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get description content.
     *
     * @return string
     */
    public function get()
    {
        return str_limit($this->getContent(), $this->getMax());
    }

    /**
     * Set description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function set($content)
    {
        $this->content = trim(strip_tags($content));

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
     * Make a description instance.
     *
     * @param  string  $content
     * @param  int     $max
     *
     * @return self
     */
    public static function make($content, $max = 155)
    {
        return new self([
            'default'   => $content,
            'max'       => $max
        ]);
    }

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

        return Meta::make($this->name, $this->get())->render();
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
        return ! empty($this->get());
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

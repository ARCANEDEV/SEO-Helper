<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Entities;

use Arcanedev\SeoHelper\Contracts\Entities\Analytics as AnalyticsContract;
use Arcanedev\SeoHelper\Traits\Configurable;

/**
 * Class     Analytics
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Analytics implements AnalyticsContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Configurable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Google Analytics code.
     *
     * @var string
     */
    protected $google = '';

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make an Analytics instance.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);

        $this->setGoogle($this->getConfig('google', ''));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set Google Analytics code.
     *
     * @param  string  $code
     *
     * @return $this
     */
    public function setGoogle($code)
    {
        $this->google = $code;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, array_filter([
            $this->renderGoogleScript(),
        ]));
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

    /* -----------------------------------------------------------------
     |  Other Functions
     | -----------------------------------------------------------------
     */

    /**
     * Render the Google Analytics tracking script.
     *
     * @return string
     */
    protected function renderGoogleScript()
    {
        if (empty($this->google))
            return '';

        return <<<EOT
<script async src="https://www.googletagmanager.com/gtag/js?id=$this->google"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '$this->google');
</script>
EOT;
    }
}

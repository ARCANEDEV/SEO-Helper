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
     */
    protected string $google = '';

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make an Analytics instance.
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
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Make Analytics instance.
     *
     * @return $this
     */
    public static function make(array $configs): static
    {
        return new static($configs);
    }

    /**
     * Set Google Analytics code.
     *
     * @return $this
     */
    public function setGoogle(string $code): static
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
     */
    public function render(): string
    {
        return implode(PHP_EOL, array_filter([
            $this->renderGoogleScript(),
        ]));
    }

    /* -----------------------------------------------------------------
     |  Other Functions
     | -----------------------------------------------------------------
     */

    /**
     * Render the Google Analytics tracking script.
     */
    protected function renderGoogleScript(): string
    {
        if (empty($this->google)) {
            return '';
        }

        return <<<EOT
<script async src="https://www.googletagmanager.com/gtag/js?id={$this->google}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{$this->google}');
</script>
EOT;
    }
}

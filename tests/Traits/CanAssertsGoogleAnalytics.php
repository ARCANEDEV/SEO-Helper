<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Traits;

/**
 * Trait     AssertGoogleAnalytics
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanAssertsGoogleAnalytics
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $id
     * @param  string  $actual
     */
    public static function assertGoogleAnalytics(string $id, string $actual): void
    {
        $expectations = [
            '<script async src="https://www.googletagmanager.com/gtag/js?id='.$id.'"></script>',
            "gtag('config', '{$id}');",
        ];

        foreach ($expectations as $expected) {
            static::assertStringContainsString($expected, $actual);
        }
    }
}

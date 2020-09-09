<?php

declare(strict_types=1);

namespace Arcanedev\SeoHelper\Tests\Asserts;

use DOMDocument;

/**
 * Trait     AssertsHtmlStrings
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait AssertsHtmlStrings
{
    /* -----------------------------------------------------------------
     |  Custom Assertions
     | -----------------------------------------------------------------
     */

    /**
     * Assert two Html strings are equals.
     *
     * @param  string        $expected
     * @param  string|mixed  $actual
     * @param  string        $message
     */
    public static function assertHtmlStringEqualsHtmlString(string $expected, $actual, string $message = ''): void
    {
        static::assertEqualsCanonicalizing(
            static::convertToDomDocument($expected),
            static::convertToDomDocument((string) $actual),
            $message
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert string to DOMDocument.
     *
     * @param  string  $html
     *
     * @return \DOMDocument
     */
    protected static function convertToDomDocument($html): DOMDocument
    {
        return tap(new DOMDocument, function (DOMDocument $dom) use ($html) {
            $dom->loadHTML(preg_replace('/>\s+</', '><', $html));
            $dom->preserveWhiteSpace = false;
        });
    }
}


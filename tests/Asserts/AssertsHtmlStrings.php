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
     */
    public static function assertHtmlStringEqualsHtmlString(string $expected, mixed $actual, string $message = ''): void
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
     */
    protected static function convertToDomDocument(string $html): DOMDocument
    {
        return tap(new DOMDocument(), function (DOMDocument $dom) use ($html): void {
            $dom->loadHTML(preg_replace('/>\s+</', '><', $html));
            $dom->preserveWhiteSpace = false;
        });
    }
}

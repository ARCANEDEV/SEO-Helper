<?php namespace Arcanedev\SeoHelper\Tests\Asserts;

use DOMDocument;

/**
 * Trait     AssertsHtmlStrings
 *
 * @package  Arcanedev\SeoHelper\Tests\Asserts
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
     * @param  string  $expected
     * @param  string  $actual
     * @param  string  $message
     */
    public static function assertHtmlStringEqualsHtmlString(string $expected, string $actual, string $message = '')
    {
        static::assertEqualsCanonicalizing(
            static::convertToDomDocument($expected),
            static::convertToDomDocument($actual),
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
    protected static function convertToDomDocument($html)
    {
        return tap(new DOMDocument, function (DOMDocument $dom) use ($html) {
            $dom->loadHTML(preg_replace('/>\s+</', '><', $html));
            $dom->preserveWhiteSpace = false;
        });
    }
}


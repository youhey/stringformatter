<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter;

interface FormatterInterface
{
    /**
     * Parse given format.
     *
     * @return string
     */
    public function compile(): string;
}

<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers;

interface CompilerInterface
{
    /**
     * Compile format and fill it's placeholders
     *
     * @return string
     */
    public function run(): string;
}

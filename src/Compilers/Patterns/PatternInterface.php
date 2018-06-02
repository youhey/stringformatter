<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers\Patterns;

interface PatternInterface
{
    /**
     * pattern matching
     *
     * @param string $str
     *
     * @return bool
     */
    public function match(string $str): bool;

    /**
     * replacement
     *
     * @return string
     */
    public function replace(): string;
}

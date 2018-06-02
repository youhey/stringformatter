<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers\Concerns;

use Youhey\StringFormatter\Compilers\Patterns\PatternInterface;
use Youhey\StringFormatter\Exceptions\CompileErrorException;
use Youhey\StringFormatter\Exceptions\MissingArgumentException;

trait CompilableTrait
{
    /** @var PatternInterface[] */
    protected $patterns;

    abstract protected function tokenize(string $format, callable $callback): string;

    /**
     * Register compile pattern
     *
     * @param PatternInterface $pattern
     *
     * @return void
     */
    protected function registerPattern(PatternInterface $pattern)
    {
        $this->patterns[] = $pattern;
    }

    /**
     * Compile format and fill it's placeholders
     *
     * @param string $format
     *
     * @return string
     *
     * @throws MissingArgumentException
     * @throws CompileErrorException
     */
    protected function compile(string $format): string
    {
        return $this->tokenize($format, function (array $match): string {
            if (empty($match)) {
                throw new CompileErrorException('Token data does not exists');
            }

            if (count($match) === 1) {
                return $match[0];
            }

            foreach ($this->patterns as $pattern) {
                if ($pattern->match($match[1])) {
                    return $pattern->replace();
                }
            }

            throw new CompileErrorException("Unknown token type: {$match[0]}");
        });
    }
}

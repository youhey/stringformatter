<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers;

use Youhey\StringFormatter\Compilers\Patterns\PatternInterface;
use Youhey\StringFormatter\ParameterMaps\MapInterface;
use Youhey\StringFormatter\Exceptions\CompileErrorException;
use Youhey\StringFormatter\Exceptions\MissingArgumentException;

class NamedCompiler implements CompilerInterface
{
    use Concerns\TokenizableTrait, Concerns\CompilableTrait;

    /** Regular expressions for key used in format. */
    const REGEXP_PLACEHOLDER = '\w*';

    /** @var string */
    protected $format;

    /** @var MapInterface */
    protected $params;

    /**
     * constructor.
     *
     * @param string $format
     * @param MapInterface $params
     * @param PatternInterface ...$patterns
     */
    public function __construct(string $format, MapInterface $params, PatternInterface ...$patterns)
    {
        $this->format = $format;
        $this->params = $params;

        foreach ($patterns as $pattern) {
            $this->registerPattern($pattern);
        }
    }

    /**
     * Compile format
     *
     * @return string
     *
     * @throws MissingArgumentException
     * @throws CompileErrorException
     */
    public function run(): string
    {
        return $this->compile($this->format);
    }
}

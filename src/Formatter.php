<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter;

class Formatter implements FormatterInterface
{
    /** @var string Store provided by user format string. */
    protected $format = null;

    /**
     * constructor.
     *
     * @param string $format format to compile
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * Parse given format and fill it's placeholders with params.
     *
     * @param mixed $params Named parameters array or Indexed args
     * @param mixed $_ [optional] <p>Another variable ...</p>
     *
     * @return string
     *
     * @throws Exceptions\MissingArgumentException
     * @throws Exceptions\CompileErrorException
     */
    public function compile(...$args): string
    {
        $params = ((count($args) === 1) && is_array($args[0])) ? $this->named($args[0]) : $this->indexed(...$args);

        $compiler = new Compilers\NamedCompiler($this->format, $params, ...[
            new Compilers\Patterns\SimplePlaceholder($params),
        ]);

        return $compiler->run();
    }

    /**
     * Named parameters
     *
     * @param array $params
     *
     * @return ParameterMaps\NamedMap
     *
     * @throws Exceptions\CompileErrorException
     * @throws Exceptions\MissingArgumentException
     */
    private function named(array $params): ParameterMaps\NamedMap
    {
        return new ParameterMaps\NamedMap($params);
    }

    /**
     * Indexed parameters
     *
     * @param string[] ...$params
     *
     * @return ParameterMaps\NamedMap
     *
     * @throws Exceptions\CompileErrorException
     * @throws Exceptions\MissingArgumentException
     */
    private function indexed(string ...$params): ParameterMaps\NamedMap
    {
        return new ParameterMaps\NamedMap($params);
    }
}

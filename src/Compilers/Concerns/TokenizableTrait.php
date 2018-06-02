<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers\Concerns;

use Youhey\StringFormatter\Exceptions\MissingArgumentException;

trait TokenizableTrait
{
    /** @var string tokenize regexp */
    private static $regexpToken = <<<PATTERN
/
  \{         # opening brace
    (
      [^}]*  # all but closing brace
    )
  \}         # closing brace
/x
PATTERN;

    /**
     * Tokenize regular expression format
     *
     * @param string $format
     * @param callable $callback
     *
     * @return mixed
     *
     * @throws MissingArgumentException
     */
    protected function tokenize(string $format, callable $callback): string
    {
        return preg_replace_callback(self::$regexpToken, $callback, $format);
    }
}

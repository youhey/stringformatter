<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers\Patterns;

use Youhey\StringFormatter\ParameterMaps\MapInterface;

/**
 * escaped placeholder
 */
class EscapedPlaceholder implements PatternInterface
{
    /** @var MapInterface */
    private $params;

    /** @var string */
    private $placeholder;

    /** @var array */
    private $match = [];

    /**
     * constructor.
     *
     * @param MapInterface $params
     * @param string $placeholder
     */
    public function __construct(MapInterface $params, string $placeholder)
    {
        $this->params      = $params;
        $this->placeholder = $placeholder;
    }

    /**
     * {@inheritdoc}
     */
    public function match(string $str): bool
    {
        $pattern = <<<"PATTERN"
/
^
  ({+)                    # escape pattern
  ({$this->placeholder})  # placeholder
$
/x
PATTERN;

        return (bool)preg_match($pattern, $str, $this->match);
    }

    /**
     * {@inheritdoc}
     */
    public function replace(): string
    {
        return $this->match[1].$this->match[2];
    }
}

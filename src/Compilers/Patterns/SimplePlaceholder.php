<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Compilers\Patterns;

use Youhey\StringFormatter\ParameterMaps\MapInterface;

/**
 * simple auto or explicit placeholder
 */
class SimplePlaceholder implements PatternInterface
{
    /** @var MapInterface */
    private $params;

    /** @var string|null */
    private $placeholder;

    /**
     * constructor.
     *
     * @param string $placeholder
     */
    public function __construct(MapInterface $params)
    {
        $this->params = $params;
    }

    /**
     * {@inheritdoc}
     */
    public function match(string $str): bool
    {
        if ($this->params->has($str)) {
            $this->placeholder = $str;
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function replace(): string
    {
        if (is_null($this->placeholder)) {
            throw new \LogicException('Placeholder does not exists');
        }

        $buf = $this->params->get($this->placeholder);
        if (is_string($buf)) {
            return $buf;
        }
        if (is_numeric($buf)) {
            return (string)$buf;
        }
        return '';
    }
}

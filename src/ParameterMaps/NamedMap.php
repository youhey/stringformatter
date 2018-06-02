<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\ParameterMaps;

use Youhey\StringFormatter\Exceptions\MissingArgumentException;

class NamedMap implements MapInterface
{
    /** @var array */
    private $params = [];

    /**
     * constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->params);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        if (!array_key_exists($key, $this->params)) {
            throw new MissingArgumentException("Parameter [{$key}] not found");
        }

        return $this->params[$key];
    }
}

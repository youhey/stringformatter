<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\ParameterMaps;

use Youhey\StringFormatter\Exceptions\MissingArgumentException;

interface MapInterface
{
    /**
     * Checks if the given key exists in the parameters.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Current parameter.
     *
     * @param string $key parameter key
     *
     * @return mixed
     *
     * @throws MissingArgumentException
     */
    public function get(string $key);
}

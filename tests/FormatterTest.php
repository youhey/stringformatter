<?php
/**
 * C# String.Format-ish String formatter
 */

namespace Youhey\StringFormatter\Tests;

use PHPUnit\Framework\TestCase;
use Youhey\StringFormatter\Formatter;

class FormatterTest extends TestCase
{
    /**
     * @test
     *
     * @throws \Youhey\StringFormatter\Exceptions\CompileErrorException
     * @throws \Youhey\StringFormatter\Exceptions\MissingArgumentException
     */
    public function namedPlaceholder()
    {
        $this->assertSame(
            'hoge, 42, tokyo',
            (new Formatter('{name}, {age}, {city}'))->compile(['name' => 'hoge', 'age' => '42', 'city' => 'tokyo'])
        );
    }
    /**
     * @test
     *
     * @throws \Youhey\StringFormatter\Exceptions\CompileErrorException
     * @throws \Youhey\StringFormatter\Exceptions\MissingArgumentException
     */
    public function indexedPlaceholder()
    {
        $this->assertSame(
            'world Hello!',
            (new Formatter('{1} {0}!'))->compile('Hello', 'world')
        );
    }

    /**
     * @test
     *
     * @throws \Youhey\StringFormatter\Exceptions\CompileErrorException
     * @throws \Youhey\StringFormatter\Exceptions\MissingArgumentException
     */
    public function nullIsEmptyString()
    {
        $this->assertSame(
            'Hello "" !',
            (new Formatter('{message} "{name}" !'))->compile(['message' => 'Hello', 'name' => null])
        );
    }

    /**
     * @test
     *
     * @throws \Youhey\StringFormatter\Exceptions\MissingArgumentException
     *
     * @expectedException \Youhey\StringFormatter\Exceptions\CompileErrorException
     */
    public function missingNamedPlaceholder()
    {
        $this->assertSame(
            'Hello "" !',
            (new Formatter('{message} "{name}" !'))->compile(['message' => 'Hello'])
        );
    }

    /**
     * @test
     *
     * @throws \Youhey\StringFormatter\Exceptions\MissingArgumentException
     *
     * @expectedException \Youhey\StringFormatter\Exceptions\CompileErrorException
     */
    public function missingIndexedPlaceholder()
    {
        $this->assertSame(
            'world Hello!',
            (new Formatter('{1} {0}!'))->compile('Hello')
        );
    }
}

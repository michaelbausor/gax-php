<?php
/*
 * Copyright 2018 Google LLC
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the following disclaimer
 * in the documentation and/or other materials provided with the
 * distribution.
 *     * Neither the name of Google Inc. nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
namespace Google\ApiCore\Tests\Unit\ResourceTemplate;

use Google\ApiCore\ResourceTemplate\Segment;
use PHPUnit\Framework\TestCase;

/**
 * Class containing shared methods for testing resource template classes.
 */
class ResourceTemplateTestUtils extends TestCase
{
    public static function literalSegment($value)
    {
        return new Segment(Segment::LITERAL_SEGMENT, $value);
    }

    public static function wildcardSegment()
    {
        return new Segment(Segment::WILDCARD_SEGMENT);
    }

    public static function doubleWildcardSegment()
    {
        return new Segment(Segment::DOUBLE_WILDCARD_SEGMENT);
    }

    public static function variableSegment($key, $template)
    {
        return new Segment(Segment::VARIABLE_SEGMENT, null, $key, $template);
    }

    /**
     * Given an array, yields all possible sequences of elements with lengths from
     * 1 to count($items).
     *
     * @param mixed[] $items
     * @return \Generator
     */
    public static function yieldAllSequences(array $items)
    {
        $keys = array_keys($items);
        foreach ($keys as $key) {
            $itemsCopy = $items;
            $value = $itemsCopy[$key];
            yield [$value];
            unset($itemsCopy[$key]);
            foreach (self::yieldAllSequences($itemsCopy) as $subsequence) {
                yield array_merge([$value], $subsequence);
            }
        }
    }

    public static function validRelativePaths()
    {
        return array_merge(self::validLiterals(), [
            ["*"],
            ["**"],
            ["5five/4/four"],
            ["{foo}", "{foo=*}"],
            ["{foo=*}"],
            ["{foo=**}"],
            ["foo/*"],
            ["*/foo"],
            ["*/*/*/*"],
            ["**/*/*"],
            ["foo/**/bar/*"],
            ["foo/*/bar/**"],
            ["foo/helloazAZ09-.~_what"],
        ]);
    }

    public static function validAbsolutePaths()
    {
        $paths = [];
        foreach (self::validRelativePaths() as $args) {
            $newArgs = [];
            foreach ($args as $arg) {
                $newArgs[] = '/' . $arg;
            }
            $paths[] = $newArgs;
        }
        return $paths;
    }

    public static function syntacticallyInvalidPaths()
    {
        return [
            ["foo:bar"],                // Contains ':'
            ["foo{barbaz"],             // Contains '{'
            ["foo}barbaz"],             // Contains '}'
            ["foo{bar}baz"],            // Contains '{' and '}'
            ["{}"],                     // Empty var
            ["{foo#bar}"],              // Invalid var
            ["{foo.bar=baz"],           // Unbalanced '{'
            ["{foo.bar=baz=fizz}"],     // Multiple '=' in variable
            ["{foo.bar=**/**}"],        // Invalid resource template
        ];
    }

    public static function invalidRelativePaths()
    {
        return array_merge(self::syntacticallyInvalidPaths(), [
            [null],                     // Null path
            [""],                       // Empty path
            ["/foo"],                   // Leading '/'
        ]);
    }

    public static function invalidAbsolutePaths()
    {
        $badSyntaxPaths = [];
        foreach (self::syntacticallyInvalidPaths() as list($invalidPath)) {
            $badSyntaxPaths[] = ['/' . $invalidPath . ':action'];
        }
        return array_merge($badSyntaxPaths, [
            [null],                     // Null path
            [""],                       // Empty path
            ["foo"],                    // Missing '/'
        ]);
    }

    public static function validLiterals()
    {
        return [
            ["foo"],
            ["helloazAZ09-.~_what"],
            ["5"],
            ["5five"],
        ];
    }

    public static function invalidLiterals()
    {
        return [
            [null],
            [""],
            ["fo\$o"],
            ["fo{o"],
            ["fo}o"],
            ["fo/o"],
            ["fo#o"],
            ["fo%o"],
            ["fo\\o"],
        ];
    }

    public static function validBindings()
    {
        return array_merge(
            self::validLiterals(),
            [
                ["fo#o"],
                ["fo%o"],
                ["fo!o"],
                ["fo@o"],
                ["fo#o"],
                ["fo\$o"],
                ["fo%o"],
                ["fo^o"],
                ["fo&o"],
                ["fo*o"],
                ["fo(o"],
                ["fo)o"],
                ["fo{o"],
                ["fo}o"],
                ["fo+o"],
                ["fo=o"],
            ]
        );
    }

    public static function invalidBindings()
    {
        return [
            [null],
            [""],
            ["fo/o"],
        ];
    }

    public static function validDoubleWildcardBindings()
    {
        return array_merge(
            self::validBindings(),
            [
                ["fo/o"]
            ]
        );
    }

    public static function invalidDoubleWildcardBindings()
    {
        return [
            [null],
            [""],
        ];
    }

    // Below this point are tests for some of the utility methods above

    /**
     * @dataProvider sequenceProvider
     * @param $sequence
     * @param $expectedSequences
     */
    public function testYieldAllSequences($sequence, $expectedSequences)
    {
        $actual = iterator_to_array(self::yieldAllSequences($sequence));
        $this->assertEquals($expectedSequences, $actual);
    }

    public function sequenceProvider()
    {
        return [
            [['a'], [['a']]],
            [['a', 'b'], [
                ['a'],
                ['a', 'b'],
                ['b'],
                ['b', 'a'],
            ]],
            [['a', 'b', 'c'], [
                ['a'],
                ['a', 'b'],
                ['a', 'b', 'c'],
                ['a', 'c'],
                ['a', 'c', 'b'],
                ['b'],
                ['b', 'a'],
                ['b', 'a', 'c'],
                ['b', 'c'],
                ['b', 'c', 'a'],
                ['c'],
                ['c', 'a'],
                ['c', 'a', 'b'],
                ['c', 'b'],
                ['c', 'b', 'a'],
            ]],
        ];
    }
}

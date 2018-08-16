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
namespace Google\ApiCore\Tests\Unit;

use Google\ApiCore\ResourceTemplate\Parser;
use Google\ApiCore\ResourceTemplate\RelativeResourceTemplate;
use Google\ApiCore\ResourceTemplate\Segment;
use Google\ApiCore\Tests\Unit\ResourceTemplate\ResourceTemplateTestUtils;
use Google\ApiCore\ValidationException;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    /**
     * @dataProvider bindToProvider
     * @param Segment $segment
     * @param string $value
     * @throws \Google\ApiCore\ValidationException
     */
    public function testBindTo($segment, $value)
    {
        $literalSegment = $segment->bindTo($value);
        $this->assertEquals($value, $literalSegment->getValue());
        $this->assertEquals($value, (string) $literalSegment);
        $this->assertEquals(Segment::LITERAL_SEGMENT, $literalSegment->getSegmentType());
    }

    public function bindToProvider()
    {
        $singleWildcardBindings = [];
        foreach (ResourceTemplateTestUtils::validBindings() as list($binding)) {
            $singleWildcardBindings[] = [ResourceTemplateTestUtils::wildcardSegment(), $binding];
        }

        $doubleWildcardBindings = [];
        foreach (ResourceTemplateTestUtils::validDoubleWildcardBindings() as list($binding)) {
            $doubleWildcardBindings[] = [ResourceTemplateTestUtils::doubleWildcardSegment(), $binding];
        }

        $literalBindings = [];
        foreach (ResourceTemplateTestUtils::validLiterals() as list($literal)) {
            $literalBindings[] = [
                ResourceTemplateTestUtils::literalSegment($literal),
                $literal
            ];
        }

        $nonVariableBindings = array_merge($singleWildcardBindings, $doubleWildcardBindings, $literalBindings);

        // Every non-variable binding should be able to be placed into a variable and
        // bind to the same value.
        $variableBindings = [];
        foreach ($nonVariableBindings as list($segment, $value)) {
            $variable = ResourceTemplateTestUtils::variableSegment(
                "mykey",
                new RelativeResourceTemplate((string) $segment)
            );
            $variableBindings[] = [$variable, $value];
        }

        return array_merge($nonVariableBindings, $variableBindings);
    }

    /**
     * @dataProvider bindToFailProvider
     * @param Segment $segment
     * @param string $value
     * @expectedException \Google\ApiCore\ValidationException
     */
    public function testFailBindTo($segment, $value)
    {
        $segment->bindTo($value);
    }

    public function bindToFailProvider()
    {
        $singleWildcardBindings = [];
        foreach (ResourceTemplateTestUtils::invalidBindings() as list($binding)) {
            $singleWildcardBindings[] = [ResourceTemplateTestUtils::wildcardSegment(), $binding];
        }

        $doubleWildcardBindings = [];
        foreach (ResourceTemplateTestUtils::invalidDoubleWildcardBindings() as list($binding)) {
            $doubleWildcardBindings[] = [ResourceTemplateTestUtils::doubleWildcardSegment(), $binding];
        }

        $literalBindings = [
            [ResourceTemplateTestUtils::literalSegment("value"), "othervalue"],
            [ResourceTemplateTestUtils::literalSegment("value"), ""],
            [ResourceTemplateTestUtils::literalSegment("value"), null],
        ];

        $nonVariableBindings = array_merge($singleWildcardBindings, $doubleWildcardBindings, $literalBindings);

        // Every non-variable binding should be able to be placed into a variable and
        // fail to bind to the same value.
        $variableBindings = [];
        foreach ($nonVariableBindings as list($segment, $value)) {
            $variable = ResourceTemplateTestUtils::variableSegment(
                "mykey",
                new RelativeResourceTemplate((string) $segment)
            );
            $variableBindings[] = [$variable, $value];
        }

        return array_merge($nonVariableBindings, $variableBindings);
    }
}

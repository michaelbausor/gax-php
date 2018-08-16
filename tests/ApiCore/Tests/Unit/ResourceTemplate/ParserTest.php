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
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @dataProvider validPathProvider
     * @param string $path
     * @param Segment[] $expectedSegments
     * @throws \Google\ApiCore\ValidationException
     */
    public function testParseSegments($path, $expectedSegments)
    {
        $actualSegments = Parser::parseSegments($path);
        $this->assertEquals($expectedSegments, $actualSegments);
    }

    public function validPathProvider()
    {
        $singleLiteralTests = [];
        foreach (ResourceTemplateTestUtils::validLiterals() as list($validLiteral)) {
            $singleLiteralTests[] = [$validLiteral, [ResourceTemplateTestUtils::literalSegment($validLiteral)]];
        }

        $singleWildcardTests = [
            ["*", [ResourceTemplateTestUtils::wildcardSegment()]],
            ["**", [ResourceTemplateTestUtils::doubleWildcardSegment()]],
        ];

        $singleVariableTests = [
            ["{foo}", Parser::parseSegments("{foo=*}")],
            ["{foo=*}", [ResourceTemplateTestUtils::variableSegment("foo", new RelativeResourceTemplate("*"))]],
            ["{foo=**}", [ResourceTemplateTestUtils::variableSegment("foo", new RelativeResourceTemplate("**"))]],
        ];

        $comboPathPieces = [
            ["foo", [ResourceTemplateTestUtils::literalSegment("foo")]],
            ["helloazAZ09-.~_what", [ResourceTemplateTestUtils::literalSegment("helloazAZ09-.~_what")]],
            ["*", [ResourceTemplateTestUtils::wildcardSegment()]],
            ["*", [ResourceTemplateTestUtils::wildcardSegment()]],
            ["**", [ResourceTemplateTestUtils::doubleWildcardSegment()]],
        ];

        // Combine the pieces in $comboPathPieces in every possible order
        $comboPathTests = [];
        foreach (ResourceTemplateTestUtils::yieldAllSequences($comboPathPieces) as $comboSequence) {
            $pathPieces = [];
            $segments = [];
            foreach ($comboSequence as list($path, $segmentArray)) {
                $pathPieces[] = $path;
                $segments = array_merge($segments, $segmentArray);
            }
            $comboPathTests[] = [implode('/', $pathPieces), $segments];
        }

        return array_merge($singleLiteralTests, $singleWildcardTests, $singleVariableTests, $comboPathTests);
    }

    /**
     * Test parseSegments on invalid input, including all invalid literals.
     *
     * @dataProvider invalidPathProvider
     * @expectedException \Google\ApiCore\ValidationException
     * @param string $path
     */
    public function testParseInvalid($path)
    {
        Parser::parseSegments($path);
    }

    public function invalidPathProvider()
    {
        return array_merge(ResourceTemplateTestUtils::invalidRelativePaths(), ResourceTemplateTestUtils::invalidLiterals());
    }
}

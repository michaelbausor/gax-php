<?php
/*
 * Copyright 2018, Google Inc.
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

use Google\ApiCore\AgentHeaderDescriptor;
use Google\ApiCore\AuthWrapper;
use Google\ApiCore\Call;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\LongRunning\OperationsClient;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Testing\MockRequest;
use Google\ApiCore\Transport\GrpcTransport;
use Google\ApiCore\Transport\RestTransport;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use GPBMetadata\Google\Api\Auth;
use GuzzleHttp\Promise\PromiseInterface;
use PHPUnit\Framework\TestCase;

class LongRunningGapicClientTraitTest extends TestCase
{
    public function testStartOperationsCall()
    {
        $agentHeaderDescriptor = $this->getMockBuilder(AgentHeaderDescriptor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $agentHeaderDescriptor->expects($this->once())
            ->method('getHeader')
            ->will($this->returnValue([]));
        $retrySettings = $this->getMockBuilder(RetrySettings::class)
            ->disableOriginalConstructor()
            ->getMock();
        $expectedPromise = $this->getMock(PromiseInterface::class);
        $transport = $this->getMock(TransportInterface::class);
        $transport->expects($this->once())
             ->method('startUnaryCall')
             ->will($this->returnValue($expectedPromise));
        $authWrapper = AuthWrapper::build([]);
        $client = new ClientTraitStub();
        $client->set('transport', $transport);
        $client->set('authWrapper', $authWrapper);
        $client->set('agentHeaderDescriptor', $agentHeaderDescriptor);
        $client->set('retrySettings', ['method' => $retrySettings]);
        $message = new MockRequest();
        $operationsClient = $this->getMockBuilder(OperationsClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client->call('startOperationsCall', [
            'method',
            [],
            $message,
            $operationsClient
        ]);
    }
}
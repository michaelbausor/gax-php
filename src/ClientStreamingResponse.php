<?php
/*
 * Copyright 2016, Google Inc.
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
namespace Google\Gax;

use Grpc;

/**
 * ClientStreamingResponse is the response object from a gRPC client streaming API call.
 */
class ClientStreamingResponse
{
    private $call;

    /**
     * ClientStreamingResponse constructor.
     *
     * @param \Grpc\ClientStreamingCall $clientStreamingCall The gRPC client streaming call object
     */
    public function __construct($clientStreamingCall)
    {
        $this->call = $clientStreamingCall;
    }

    /**
     * Write data to the server.
     *
     * @param mixed $data The data to write
     */
    public function write($data)
    {
        $this->call->write($data);
    }

    /**
     * Wait for the server to return a response object.
     *
     * @return mixed The response object from the server
     * @throws ApiException
     */
    public function wait()
    {
        list($response, $status) = $this->call->wait();
        if ($status->code == Grpc\STATUS_OK) {
            return $response;
        } else {
            throw new ApiException($status->details, $status->code);
        }
    }

    /**
     * Write all data in $dataArray and wait for the server to return a response object.
     *
     * @param mixed[] $dataArray An iterator of data objects to write to the server
     * @return mixed The response object from the server
     */
    public function writeAllAndWait($dataArray)
    {
        foreach ($dataArray as $data) {
            $this->write($data);
        }
        return $this->wait();
    }

    /**
     * Return the underlying gRPC call object
     *
     * @return \Grpc\ClientStreamingCall
     */
    public function getClientStreamingCall() {
        return $this->call;
    }
}
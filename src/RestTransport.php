<?php
/*
 * Copyright 2017, Google Inc.
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
namespace Google\GAX;

use Google\Auth\ApplicationDefaultCredentials;
use Google\Auth\Cache\MemoryCacheItemPool;
use Google\Auth\CredentialsLoader;
use Google\Auth\FetchAuthTokenCache;
use Google\GAX\HttpHandler\Guzzle6HttpHandler;
use Google\Protobuf\Internal\Message;
use Psr\Http\Message\ResponseInterface;

class RestTransport implements ApiTransportInterface
{
    use ApiTransportTrait;
    use CallStackTrait;
    use ValidationTrait;

    /**
     * @param string $host The domain name and port of the API remote host.
     * @param array $options {
     *     Optional.
     *
     *     @type string[] $scopes
     *           A list of scopes required for API access. Exactly one of
     *           $scopes or $credentialsLoader must be provided.
     *           NOTE: if $credentialsLoader is provided, this argument is
     *           ignored.
     *     @type FetchAuthTokenInterface $credentialsLoader
     *           A user-created CredentialsLoader object. Defaults to using
     *           ApplicationDefaultCredentials with the provided $scopes argument.
     *           Exactly one of $scopes or $credentialsLoader must be provided.
     *     @type boolean $enableCaching
     *           Enable caching of access tokens. Defaults to true.
     *     @type CacheItemPoolInterface $authCache
     *           A cache for storing access tokens. Defaults to a simple in
     *           memory implementation.
     *     @type array $authCacheOptions
     *           Cache configuration options.
     *     @type callable $httpHandler
     *           A handler used to deliver Psr7 requests.
     *     @type callable $authHttpHandler
     *           A handler used to deliver Psr7 requests specifically for
     *           authentication.
     * }
     */
    public function __construct($host, array $options = [])
    {
        $options = $this->setCommonDefaults($options + [
            'httpHandler' => new Guzzle6HttpHandler() // @todo use factory
        ]);

        $this->httpHandler = $options['httpHandler'];
        $this->credentialsLoader = $options['credentialsLoader'];
        $this->requestBuilder = new RequestBuilder(
            $host,
            $options['restClientConfigPath']
        );
    }

    /**
     * @param string $method The method to start a call for.
     * @param Message $message The message to deliver.
     * @param string $decodeTo The type to decode the response to.
     * @param CallSettings $settings The call settings to use for this call.
     *
     * @return PromiseInterface
     */
    public function startCall($method, Message $message, $decodeTo, CallSettings $settings)
    {
        $httpHandler = $this->httpHandler;
        $request = $this->requestBuilder->build(
            $method,
            $message
        )->withHeader(
            'Authorization',
            'Bearer ' . $this->credentialsLoader->fetchAuthToken()['access_token']
        );

        return $httpHandler($request)->then(
            function (ResponseInterface $response) use ($decodeTo) {
                return (new Serializer)
                    ->decodeMessage(
                        new $decodeTo,
                        json_decode((string) $response->getBody(), true)
                    );
            }
        );
    }

    /**
     * @param string $method The method to start a call for.
     * @param string $decodeTo The type to decode the response to.
     * @param CallSettings $settings The call settings to use for this call.
     * @param Message $message The message to deliver.
     *
     * @return StreamingCallInterface
     * @todo interface for streaming calls?
     */
    public function startStreamingCall($method, $decodeTo, CallSettings $callSettings, Message $message = null)
    {
        throw new \Exception('Not supported for REST.');
    }
}

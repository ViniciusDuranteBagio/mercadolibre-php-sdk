<?php
/**
 * OAuth20Api
 * PHP version 5
 *
 * @category Class
 * @package  Meli
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * MELI Markeplace SDK
 *
 * This is a the codebase to generate a SDK for Open Platform Marketplace
 *
 * The version of the OpenAPI document: 3.0.0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Meli\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Meli\ApiException;
use Meli\Configuration;
use Meli\HeaderSelector;
use Meli\ObjectSerializer;

/**
 * OAuth20Api Class Doc Comment
 *
 * @category Class
 * @package  Meli
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class OAuth20Api
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation auth
     *
     * Authentication Endpoint
     *
     * @param  string $response_type response_type (required)
     * @param  string $client_id client_id (required)
     * @param  string $redirect_uri redirect_uri (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function auth($response_type, $client_id, $redirect_uri)
    {
        $this->authWithHttpInfo($response_type, $client_id, $redirect_uri);
    }

    /**
     * Operation authWithHttpInfo
     *
     * Authentication Endpoint
     *
     * @param  string $response_type (required)
     * @param  string $client_id (required)
     * @param  string $redirect_uri (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function authWithHttpInfo($response_type, $client_id, $redirect_uri)
    {
        $request = $this->authRequest($response_type, $client_id, $redirect_uri);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 302:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation authAsync
     *
     * Authentication Endpoint
     *
     * @param  string $response_type (required)
     * @param  string $client_id (required)
     * @param  string $redirect_uri (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function authAsync($response_type, $client_id, $redirect_uri)
    {
        return $this->authAsyncWithHttpInfo($response_type, $client_id, $redirect_uri)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation authAsyncWithHttpInfo
     *
     * Authentication Endpoint
     *
     * @param  string $response_type (required)
     * @param  string $client_id (required)
     * @param  string $redirect_uri (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function authAsyncWithHttpInfo($response_type, $client_id, $redirect_uri)
    {
        $returnType = '';
        $request = $this->authRequest($response_type, $client_id, $redirect_uri);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'auth'
     *
     * @param  string $response_type (required)
     * @param  string $client_id (required)
     * @param  string $redirect_uri (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function authRequest($response_type, $client_id, $redirect_uri)
    {
        // verify the required parameter 'response_type' is set
        if ($response_type === null || (is_array($response_type) && count($response_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $response_type when calling auth'
            );
        }
        // verify the required parameter 'client_id' is set
        if ($client_id === null || (is_array($client_id) && count($client_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $client_id when calling auth'
            );
        }
        // verify the required parameter 'redirect_uri' is set
        if ($redirect_uri === null || (is_array($redirect_uri) && count($redirect_uri) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $redirect_uri when calling auth'
            );
        }

        $resourcePath = '/authorization';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($response_type !== null) {
            if('form' === 'form' && is_array($response_type)) {
                foreach($response_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['response_type'] = $response_type;
            }
        }
        // query params
        if ($client_id !== null) {
            if('form' === 'form' && is_array($client_id)) {
                foreach($client_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['client_id'] = $client_id;
            }
        }
        // query params
        if ($redirect_uri !== null) {
            if('form' === 'form' && is_array($redirect_uri)) {
                foreach($redirect_uri as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['redirect_uri'] = $redirect_uri;
            }
        }



        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json'],
                ''
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                [],
                ''
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getToken
     *
     * Request Access Token
     *
     * @param  string $grant_type grant_type (optional)
     * @param  string $client_id client_id (optional)
     * @param  string $client_secret client_secret (optional)
     * @param  string $redirect_uri redirect_uri (optional)
     * @param  string $code code (optional)
     * @param  string $refresh_token refresh_token (optional)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function getToken($grant_type = null, $client_id = null, $client_secret = null, $redirect_uri = null, $code = null, $refresh_token = null)
    {
        list($response) = $this->getTokenWithHttpInfo($grant_type, $client_id, $client_secret, $redirect_uri, $code, $refresh_token);
        return $response;
    }

    /**
     * Operation getTokenWithHttpInfo
     *
     * Request Access Token
     *
     * @param  string $grant_type (optional)
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $redirect_uri (optional)
     * @param  string $code (optional)
     * @param  string $refresh_token (optional)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function getTokenWithHttpInfo($grant_type = null, $client_id = null, $client_secret = null, $redirect_uri = null, $code = null, $refresh_token = null)
    {
        $request = $this->getTokenRequest($grant_type, $client_id, $client_secret, $redirect_uri, $code, $refresh_token);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTokenAsync
     *
     * Request Access Token
     *
     * @param  string $grant_type (optional)
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $redirect_uri (optional)
     * @param  string $code (optional)
     * @param  string $refresh_token (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTokenAsync($grant_type = null, $client_id = null, $client_secret = null, $redirect_uri = null, $code = null, $refresh_token = null)
    {
        return $this->getTokenAsyncWithHttpInfo($grant_type, $client_id, $client_secret, $redirect_uri, $code, $refresh_token)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTokenAsyncWithHttpInfo
     *
     * Request Access Token
     *
     * @param  string $grant_type (optional)
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $redirect_uri (optional)
     * @param  string $code (optional)
     * @param  string $refresh_token (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTokenAsyncWithHttpInfo($grant_type = null, $client_id = null, $client_secret = null, $redirect_uri = null, $code = null, $refresh_token = null)
    {
        $returnType = 'object';
        $request = $this->getTokenRequest($grant_type, $client_id, $client_secret, $redirect_uri, $code, $refresh_token);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getToken'
     *
     * @param  string $grant_type (optional)
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $redirect_uri (optional)
     * @param  string $code (optional)
     * @param  string $refresh_token (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getTokenRequest($grant_type = null, $client_id = null, $client_secret = null, $redirect_uri = null, $code = null, $refresh_token = null)
    {

        $resourcePath = '/oauth/token';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        if ($grant_type !== null) {
            $formParams['grant_type'] = ObjectSerializer::toFormValue($grant_type);
        }
        // form params
        if ($client_id !== null) {
            $formParams['client_id'] = ObjectSerializer::toFormValue($client_id);
        }
        // form params
        if ($client_secret !== null) {
            $formParams['client_secret'] = ObjectSerializer::toFormValue($client_secret);
        }
        // form params
        if ($redirect_uri !== null) {
            $formParams['redirect_uri'] = ObjectSerializer::toFormValue($redirect_uri);
        }
        // form params
        if ($code !== null) {
            $formParams['code'] = ObjectSerializer::toFormValue($code);
        }
        // form params
        if ($refresh_token !== null) {
            $formParams['refresh_token'] = ObjectSerializer::toFormValue($refresh_token);
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json'],
                ''
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/x-www-form-urlencoded'],
                ''
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}

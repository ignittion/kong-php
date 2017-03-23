<?php

namespace Ignittion\Kong\Apis;

use Exception;
use Ignittion\Kong\Exceptions\KongHttpException;
use Unirest\Request as RestClient;
use stdClass;

abstract class AbstractApi
{
    /**
     * Array of allowed request options
     *
     * @var array
     */
    protected $allowedOptions    = [];

    /**
     * Parsed response body
     *
     * @var \stdClass
     */
    protected $body;

    /**
     * Response Array
     *
     * @return array
     */
    protected $headers;

    /**
     * Response status code
     *
     * @var integer
     */
    protected $httpCode;

    /**
     * The GuzzleHttp client
     *
     * @var integer
     */
    protected $port;

    /**
     * Unparsed response body
     *
     * @var string
     */
    protected $rawBody;

    /**
     * The Url to the admin node
     *
     * @var string
     */
    protected $url;

    /**
     * Global request headers
     *
     * @var array
     */
    protected $request_headers = ['Content-Type: application/json'];

    /**
     * Class Constructor
     *
     * @param string $url
     * @param integer $port
     */
    public function __construct($url, $port)
    {
        $this->port    = $port;
        $this->url    = $url;
    }

    /**
     * The underlying call to the Kong Server
     *
     * @throws \Ignittion\Kong\Exceptions\KongHttpException when something goes
     *      wrong with the Http request.
     *
     * @param string $verb
     * @param string $uri
     * @param array $options
     * @param array $body
     * @return \stdClass
     */
    public function call($verb, $uri, array $params = [], array $body = [], array $headers = [])
    {
        $verb        = strtoupper($verb);
        $api        = "{$this->url}:{$this->port}/{$uri}";
        $headers    = array_merge(
            $headers,
            $this->request_headers
        );

        try {
            switch ($verb) {

                case 'GET':
                    $request    = RestClient::get($api, $headers, $params);
                break;

                case 'POST':
                    $request    = RestClient::post($api, $headers, $body);
                break;

                case 'PUT':
                    $request    = RestClient::put($api, $headers, $body);
                break;

                case 'PATCH':
                    $request    = RestClient::patch($api, $headers, $body);
                break;

                case 'DELETE':
                    $request    = RestClient::delete($api, $headers);
                break;

                default:
                    throw new Exception('Unknown HTTP Request method.');
            }
        } catch (Exception $e) {
            throw new KongHttpException($e->getMessage());
        }

        // save this request
        $this->body        = $request->body;
        $this->headers    = $request->headers;
        $this->httpCode    = $request->code;
        $this->rawBody    = $request->raw_body;

        // return a more simplified response
        $object                = new stdClass();
        $object->code        = $this->httpCode;
        $object->data        = $this->body;

        return $object;
    }

    /**
     * Return last response parsed body
     *
     * @return \stdClass
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Return response http headers of last request
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Return the last requests http status code
     *
     * @return integer
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * Returns the last requests raw_body
     *
     * @return \stdClass
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }

    /**
     * Set headers to be used during the request
     *
     * @param array $headers
     * @param bool  $merge
     *
     * @return $this
     */
    public function setHeaders(array $headers, $merge = true)
    {
        $this->request_headers = $merge ? array_merge($this->request_headers, $headers) : $headers;

        return $this;
    }

    /**
     * Build a request body
     *
     * @param array $options
     * @param array $merge
     * @return array
     */
    protected function createRequestBody(array $options, array $merge = [])
    {
        $body   = [];
        foreach ($options as $index => $value) {

            // The plugin api has params like "config.*" so we'll need to allow
            // any option that begins with that.
            if (! in_array($index, $this->allowedOptions) && strpos($index, 'config.') < 0) {
                continue;
            }

            $body[$index]   = $value;
        }

        return array_merge($body, $merge);
    }
}

<?php

namespace Ignittion\Kong;

use Ignittion\Kong\Apis\Api;
use Ignittion\Kong\Apis\Consumer;
use Ignittion\Kong\Apis\Node;
use Ignittion\Kong\Apis\OAuth2Plugin;
use Ignittion\Kong\Apis\Plugin;
use Ignittion\Kong\Exceptions\InvalidUrlException;

class Kong
{
    /**
     * The port that the Kong Admin is listening on
     *
     * @var integer
     */
    protected $port = 8001;

    /**
     * The based URL to the Kong Gateway
     *
     * @var string
     */
    protected $url;

    /**
     * Class Constructor
     *
     * @throws \Ignittion\Kong\Exceptions\InvalidUrlException when non-RFC
     *      compliant url is given.
     *
     * @param string $url
     * @param integer $port
     */
    public function __construct($url, $port = 8001)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException($url);
        }

        $this->port = $port;
        $this->url  = rtrim($url, '/');
    }

    /**
     * Returns a new instance of the API...api
     *
     * @return \Ignittion\Kong\Apis\Api
     */
    public function api()
    {
        return new Api($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Consumer API
     *
     * @return \Ignittion\Kong\Apis\consumer
     */
    public function consumer()
    {
        return new Consumer($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Node API
     *
     * @return \Ignittion\Kong\Apis\Node
     */
    public function node()
    {
        return new Node($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Plugin API
     *
     * @return \Ignittion\Kong\Apis\Plugin
     */
    public function plugin()
    {
        return new Plugin($this->url, $this->port);
    }

    /**
     * Returns a new instance of the OAuth2 Plugin API
     *
     * @return \Ignittion\Kong\Apis\OAuth2Plugin
     */
    public function oauth2Plugin ()
    {
        return new OAuth2Plugin($this->url, $this->port);
    }
}
